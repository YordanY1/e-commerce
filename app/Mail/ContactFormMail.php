<?php

namespace App\Mail;

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->from('jeronimostore1@gmail.com', 'Jeronimo')
                    ->replyTo($this->details['email'])
                    ->subject($this->details['subject'])
                    ->view('emails.contact');
    }
}
