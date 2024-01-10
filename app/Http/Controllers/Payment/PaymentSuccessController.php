<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Routing\Controller;

class PaymentSuccessController extends Controller
{
    public function index()
    {
        return view('payment.success', []);
    }
}