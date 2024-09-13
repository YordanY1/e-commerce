<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderConfirmationOwnerMail;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page with Stripe details.
     */
    public function index(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = $request->session()->get('cart', []);
        $totalAmountLev = $this->calculateCartTotal($cart); // Total amount including VAT in Lev

        // Convert amount to stotinki for Stripe
        $totalAmountStotinki = $totalAmountLev * 100;

        // Check if the amount meets Stripe's minimum requirement for BGN
        if ($totalAmountStotinki < 100) { // Stripe's minimum amount for BGN is usually 100 stotinki (1 BGN)
            Log::error('Total amount too low for Stripe processing.', ['Amount' => $totalAmountStotinki]);
            return back()->withErrors('Total amount too low for processing. Minimum amount required is 1 BGN.');
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmountStotinki,
                'currency' => 'bgn',
            ]);

            return view('checkout.checkout', [
                'clientSecret' => $paymentIntent->client_secret,
                'stripeKey' => env('STRIPE_KEY'),
                'paymentIntentId' => $paymentIntent->id,
                'totalAmount' => $totalAmountLev,
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Error creating Payment Intent: ' . $e->getMessage());
            return back()->withErrors('Error initiating payment process. Please try again.');
        }
    }


    /**
     * Calculate the total cart amount in Lev.
     */
    private function calculateCartTotal($cart)
    {
        $total = 0;
        if (isset($cart['products']) && is_array($cart['products'])) {
            foreach ($cart['products'] as $item) {
                $total += (float)$item['price'] * (int)$item['quantity'];
            }
        }
        return $total; // Returns total in Lev, including VAT
    }

    /**
     * Handle the successful payment page.
     */
    public function success(Request $request)
    {
        // Clear the session cart
        $request->session()->forget('cart');
        return view('checkout.success');
    }

     /**
     * Process the payment on the server-side after receiving the payment confirmation from the front-end.
     */
    public function processPayment(Request $request)
    {
        $validatedData = $request->validate([
            'payment_intent_id' => 'required|string',
            'payment_method' => 'required|string',
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'street' => 'required|string|max:255',
        ]);

        // Log::info('processPayment: Start', ['Session ID' => session()->getId(), 'Request Data' => $request->all()]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntentId = $request->input('payment_intent_id');
        $paymentMethod = $request->input('payment_method', 'Плащане с карта');

        // Initialize invoice details with default values
        $invoiceDetails = ['invoiceRequested' => false];

        if ($request->input('invoiceRequest')) {
            $validatedInvoiceDetails = $request->validate([
                'companyName' => 'required|string|max:255',
                'companyID' => 'required|string|max:255',
                'companyAddress' => 'required|string|max:255',
                'companyTaxNumber' => 'required|string|max:255',
                'companyMol' => 'required|string|max:255',
            ]);

            $invoiceDetails = array_merge($validatedInvoiceDetails, ['invoiceRequested' => true]);
        }

        try {
            $intent = PaymentIntent::retrieve($paymentIntentId);
            // Log::info('processPayment: PaymentIntent retrieved', ['Intent Status' => $intent->status]);

            if ($intent->status === 'succeeded') {
                $cart = $request->session()->get('cart', []);

                // **Запазване на данните на клиента**
                $customer = Customer::updateOrCreate(
                    ['email' => $validatedData['email']],
                    [
                        'first_name' => $validatedData['first_name'],
                        'last_name' => $validatedData['last_name'],
                        'phone' => $validatedData['phone'],
                        'city' => $validatedData['city'],
                        'postcode' => $validatedData['postcode'],
                        'street' => $validatedData['street'],
                    ]
                );

                // **Актуализиране на наличностите на продуктите**
                foreach ($cart['products'] as $productId => $productDetails) {
                    $product = Product::find($productId);
                    if ($product) {
                        $newQuantity = $product->quantity - $productDetails['quantity'];
                        $product->quantity = $newQuantity >= 0 ? $newQuantity : 0;
                        $product->save();
                    }
                }

                // **Изчисляване на сумите**
                $totalAmount = $intent->amount_received / 100; // Total amount in Lev, including VAT
                $amountBeforeVAT = $totalAmount / 1.2; // Calculate amount before VAT
                $vatAmount = $totalAmount - $amountBeforeVAT; // 20% VAT of the amount before VAT

                // **Създаване на запис за плащане**
                $payment = new Payment();
                $payment->stripe_payment_intent_id = $intent->id;
                $payment->amount = $amountBeforeVAT; // Amount before VAT
                $payment->vat_amount = $vatAmount; // VAT amount
                $payment->total_amount = $totalAmount; // Total amount
                $payment->currency = $intent->currency;
                $payment->status = 1;
                $payment->session_id = $request->session()->getId();
                $payment->save();

                // **Създаване на нова поръчка**
                $order = new Order();
                $order->customer_id = $customer->id;
                $order->payment_id = $payment->id;
                $order->order_number = Str::uuid();
                $order->total_amount = $totalAmount;
                $order->save();

                // **Запазване на артикулите в поръчката**
                foreach ($cart['products'] as $productId => $productDetails) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $productId;
                    $orderItem->quantity = $productDetails['quantity'];
                    $orderItem->price = $productDetails['price'];
                    $orderItem->total = $productDetails['price'] * $productDetails['quantity'];
                    $orderItem->save();
                }

                // **Подготовка на данни за имейл**
                $emailData = [
                    'customer' => $customer, // Можете да използвате $customer вместо $customerDetails
                    'cart' => $cart,
                    'payment' => [
                        'amount' => number_format($amountBeforeVAT, 2),
                        'vatAmount' => number_format($vatAmount, 2),
                        'totalAmount' => number_format($totalAmount, 2),
                        'currency' => $intent->currency,
                        'method' => $paymentMethod
                    ]
                ];

                // **Изпращане на имейли (ако желаете)**
                // Mail::to($customer->email)->send(new OrderConfirmationMail($cart, $emailData['payment'], $customer));
                // Mail::to('jeronimostore1@gmail.com')->send(new OrderConfirmationOwnerMail($cart, $emailData['payment'], $customer, $paymentMethod, $invoiceDetails));

                // **Изчистване на количката от сесията**
                $request->session()->forget('cart');

                return redirect()->route('checkout.success');
            } else {
                Log::error("processPayment: Payment failed", ['Status' => $intent->status]);
                return redirect()->route('checkout.failure')->withErrors("Payment failed with status: {$intent->status}");
            }
        } catch (\Exception $e) {
            Log::error('processPayment: Payment processing failed', ['Error' => $e->getMessage()]);
            return redirect()->route('checkout.failure')->withErrors('Payment processing failed. Please try again.');
        }
    }
}
