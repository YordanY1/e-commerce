<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Stripe\{Stripe, Customer, Charge};

class StripePaymentApiController extends Controller
{
    function charge(Request $request) {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'email' => 'required|email',
            'stripeToken' => 'required',
        ]);
        
        // Set your Stripe API key. - .env file - STRIPE_SECRET
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the payment amount and email address from the form.
        $amount = $request->input('amount') * 100;
        $email = $request->input('email');

        // Create a new Stripe customer. -- TODO use record if exists
        $customer = Customer::create([
            'email' => $email,
            'source' => $request->input('stripeToken'),
        ]);
    
        // Create a new Stripe charge.
        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'bgn',
        ]);

        // Display a success message to the user.
        return true;
    }
}