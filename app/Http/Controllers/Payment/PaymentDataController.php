<?php

namespace App\Http\Controllers\Payment;

use Auth;
use Illuminate\Routing\Controller;

class PaymentDataController extends Controller
{
    public function index()
    {
        //Logged in user
        //$user = Auth::user();
        //Session user - guest user
        //$sessionUser = session()->get('user');
        //Cart data
        //$cartData = session()->get('cart');

        return view('payment.checkout', []);
    }
}