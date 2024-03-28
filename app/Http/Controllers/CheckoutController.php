<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.checkout');
    }
    public function stripeCharge()
    {
        return view('checkout.stripe.stripe');
    }
}
