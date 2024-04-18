<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class OrderConfirmationOwnerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $payment;
    public $customerDetails;
    public $paymentMethod;

    public function __construct($cart, $payment, $customerDetails, $paymentMethod)
    {
        $this->cart = $cart;
        $this->payment = $payment;
        $this->customerDetails = $customerDetails;
        $this->paymentMethod = $paymentMethod;
    }

    public function build()
    {
        return $this->markdown('emails.order.confirmation_owner')
                    ->with([
                        'cart' => $this->cart,
                        'payment' => $this->payment,
                        'customer' => $this->customerDetails,
                        'paymentMethod' => $this->paymentMethod
                    ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Нова поръчка',
        );
    }
}
