<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormAutoResponse extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this
            ->from('nothingstar142@gmail.com', 'Jeronimo')
            ->subject('Получихме вашето запитване!')
            ->view('emails.autoresponse');
    }
}
