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

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmountStotinki, // Charge the total amount including VAT
                'currency' => 'bgn',
            ]);

            return view('checkout.checkout', [
                'clientSecret' => $paymentIntent->client_secret,
                'stripeKey' => env('STRIPE_KEY'),
                'paymentIntentId' => $paymentIntent->id,
                'baseAmount' => $baseAmountLev, // Display amounts in Lev for clarity
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
        foreach ($cart['products'] as $item) {
            $total += (float)$item['price'] * (int)$item['quantity'];
        }
        return $total; // Total in Lev
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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntentId = $request->input('payment_intent_id');

        if (empty($paymentIntentId)) {
            Log::error('PaymentIntent ID not provided.');
            return back()->withErrors('Payment processing failed. Please try again.');
        }

        try {
            $intent = PaymentIntent::retrieve($paymentIntentId);

            if ($intent->status === 'succeeded') {
                $cart = $request->session()->get('cart', []);
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
                        'amount' => number_format($amountBeforeVAT, 2), // Subtotal
                        'vatAmount' => number_format($vatAmount, 2), // VAT
                        'totalAmount' => number_format($totalAmount, 2), // Total amount
                        'currency' => $intent->currency,
                    ]
                ];

                Log::info('Sending Order Confirmation Email with data:', $emailData);

                // Send confirmation email to the user
                Mail::to($userEmail)->send(new OrderConfirmationMail($cart, $emailData['payment']));

                // Optionally, notify another recipient
                Mail::to('jeronimostore1@gmail.com')->send(new OrderConfirmationMail($cart, $emailData['payment']));

                // Clear the session cart
                $request->session()->forget('cart');

                return redirect()->route('checkout.success');
            } else {
                Log::info("PaymentIntent status: {$intent->status}");
                return back()->withErrors("Payment failed with status: {$intent->status}");
            }
        } catch (\Exception $e) {
            Log::error('Payment processing failed: ' . $e->getMessage());
            return back()->withErrors('Payment processing failed. Please try again.');
        }
    }
}

