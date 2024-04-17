<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page with Stripe details.
     */
    public function index(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = $request->session()->get('cart', []);
        $baseAmountLev = $this->calculateCartTotal($cart); // Calculate the total amount in Lev

        $vatAmountLev = $baseAmountLev * 0.20; // Calculate VAT (20%)
        $totalAmountLev = $baseAmountLev + $vatAmountLev; // Total amount including VAT in Lev

        // Convert amounts to stotinki for Stripe
        $baseAmountStotinki = $baseAmountLev * 100;
        $vatAmountStotinki = $vatAmountLev * 100;
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
                'baseAmount' => $baseAmountLev,
                'vatAmount' => $vatAmountLev,
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
        return $total; // Returns total in Lev
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
        Log::info('processPayment: Start', ['Session ID' => session()->getId(), 'Request Data' => $request->all()]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntentId = $request->input('payment_intent_id');

        if (empty($paymentIntentId)) {
            Log::error('processPayment: PaymentIntent ID not provided.');
            return back()->withErrors('Payment processing failed. Please try again.');
        }

        try {
            $intent = PaymentIntent::retrieve($paymentIntentId);
            Log::info('processPayment: PaymentIntent retrieved', ['Intent Status' => $intent->status]);

            if ($intent->status === 'succeeded') {
                $cart = $request->session()->get('cart', []);
                Log::info('processPayment: Cart at payment success', ['Cart' => $cart]);

                $userEmail = $request->input('email');
                // Assuming the amount_received is in stotinki and VAT is 20%
                $amountBeforeVAT = $intent->amount_received / 100 / 1.2; // Calculate amount before VAT
                $vatAmount = $amountBeforeVAT * 0.20; // 20% VAT of the amount before VAT
                $totalAmount = $amountBeforeVAT + $vatAmount; // Total amount is the sum of the amount before VAT and VAT

                // Create a new Payment record
                $payment = new Payment();
                $payment->stripe_payment_intent_id = $intent->id;
                $payment->amount = $amountBeforeVAT; // Amount before VAT
                $payment->vat_amount = $vatAmount; // VAT amount
                $payment->total_amount = $totalAmount; // Total amount
                $payment->currency = $intent->currency;
                $payment->status = 1;
                $payment->session_id = $request->session()->getId();
                $payment->save();

                // Preparing data for email
                $emailData = [
                    'cart' => $cart,
                    'payment' => [
                        'amount' => number_format($amountBeforeVAT, 2),
                        'vatAmount' => number_format($vatAmount, 2),
                        'totalAmount' => number_format($totalAmount, 2),
                        'currency' => $intent->currency,
                    ]
                ];

                Log::info('Sending Order Confirmation Email with data:', $emailData);
                Mail::to($userEmail)->send(new OrderConfirmationMail($cart, $emailData['payment']));
                Mail::to('jeronimostore1@gmail.com')->send(new OrderConfirmationMail($cart, $emailData['payment']));
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
