<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Routing\Controller;

class PaymentFailedController extends Controller
{
    public function index()
    {
        return view('payment.failure', []);
    }
}