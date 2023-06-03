<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable implements  ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $mailContent)
    {
        $this->mailContent = $mailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact_us.index',[
            'name'      => $this->mailContent['name'],
            'message'   => $this->mailContent['message'],
            'email'     => $this->mailContent['email'],
            'subject'   => $this->mailContent['subject'],
            'url'       => $this->mailContent['url'],
        ]);
    }
}
