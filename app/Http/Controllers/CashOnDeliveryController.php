<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CashOnDeliveryController extends Controller
{
    /**
     * Process a cash on delivery order.
     */
    public function processOrder(Request $request)
    {
        Log::info('CashOnDelivery: Start', ['Session ID' => session()->getId(), 'Request Data' => $request->all()]);

        try {
            $customerDetails = $request->validate([
                'email' => 'required|email',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|string',
                'city' => 'required|string',
                'postcode' => 'required|string',
                'street' => 'required|string'
            ]);

            $cart = $request->session()->get('cart', []);
            if (empty($cart)) {
                return back()->withErrors('Cart is empty.');
            }

            $amountBeforeVAT = $this->calculateCartTotal($cart);
            $vatAmount = $amountBeforeVAT * 0.20;
            $totalAmount = $amountBeforeVAT + $vatAmount;

            // Save payment/order details
            $payment = new Payment();
            $payment->amount = $amountBeforeVAT;
            $payment->vat_amount = $vatAmount;
            $payment->total_amount = $totalAmount;
            $payment->currency = 'BGN';  // Assuming BGN is the currency
            $payment->status = 0; // Indicates pending delivery
            $payment->session_id = $request->session()->getId();
            $payment->save();

            // Email data
            $emailData = [
                'customer' => $customerDetails,
                'cart' => $cart,
                'payment' => [
                    'amount' => number_format($amountBeforeVAT, 2),
                    'vatAmount' => number_format($vatAmount, 2),
                    'totalAmount' => number_format($totalAmount, 2),
                    'currency' => 'BGN',
                ]
            ];

            Mail::to($customerDetails['email'])->send(new OrderConfirmationMail($cart, $emailData['payment'], $customerDetails));
            Mail::to('jeronimostore1@gmail.com')->send(new OrderConfirmationMail($cart, $emailData['payment'], $customerDetails));
            $request->session()->forget('cart');

            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            Log::error('CashOnDelivery: Order processing failed', ['Error' => $e->getMessage()]);
            return redirect()->route('checkout.failure')->withErrors('Order processing failed. Please try again.');
        }
    }

    /**
     * Calculate the total cart amount.
     */
    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart['products'] as $item) {
            $total += (float) $item['price'] * (int) $item['quantity'];
        }
        return $total;
    }
}
