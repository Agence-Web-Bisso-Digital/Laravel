<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModelMarkedownMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url="https://www.solacecar.com";
    public $data=[];
    public function __construct(array $client)
    {
        $this->data=$client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("ardeche@bissodigital.com")->subject('Message de confirmation')->markdown('emails.markdown-contact');
    }
}
