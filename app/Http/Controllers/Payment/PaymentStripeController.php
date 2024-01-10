<?php

namespace App\Http\Controllers\Payment;

use Auth;
use Exception;
use Illuminate\Routing\Controller;
use Log;
use \Stripe\StripeClient;

class PaymentStripeController extends Controller
{
    public function index()
    {
        return view('payment.stripe', []);
    }

    public function sendPayment()
    {
        //TODO
        //Logged in user
        //$user = Auth::user();
        //Session user - guest user
        //$sessionUser = session()->get('user');
        //Cart Data and create prices or products or use them on the go
        $cartData = session()->get('cart');

        $stripe = new StripeClient(config('secrets.stripeSecretKeyTest'));

        try {
            $result = $stripe->paymentIntents->create([
                'amount' => 2000, //amount in cents
                'currency' => 'usd', //bgn or eur
                'automatic_payment_methods' => ['enabled' => true],
                'confirm' => true, //create and pay
                'return_url' => route('payment.stripe.success') //redirect to success
              ]);

              //TODO
              //Record Payment
              //Clear Cart
        } catch (Exception $e) {
            Log::erro('Stripe Error: '. $e->getMessage());
            return redirect()->route('payment.stripe.failure');
        }

        return redirect()->route('payment.stripe.success');
    }
}