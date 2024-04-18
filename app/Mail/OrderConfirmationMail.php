<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $payment;
    public $customerDetails;


    /**
     * Create a new message instance.
     */
    public function __construct($cart, $payment, $customerDetails)
    {
        $this->cart = $cart;
        $this->payment = $payment;
        $this->customerDetails = $customerDetails;
    }

    public function build()
    {
        return $this->to($this->customerDetails['email'])
                    ->markdown('emails.order.confirmation_customer')
                    ->with([
                        'cart' => $this->cart,
                        'payment' => $this->payment,
                        'customer' => $this->customerDetails,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Потвърждение на поръчката',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order.confirmation_customer',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
