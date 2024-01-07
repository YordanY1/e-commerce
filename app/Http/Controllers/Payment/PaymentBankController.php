<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class PaymentBankController extends Controller
{
    public function index()
    {
        return view('payment.bank', []);
    }

    public function sendPayment(Request $request)
    {
        return view('payment.success', []);
    }
}