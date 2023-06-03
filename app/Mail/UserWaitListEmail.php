<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWaitListEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $waitListContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $_waitListContent)
    {
        $this->waitListContent = $_waitListContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.user-wait-list-email',[
            'email'     => $this->waitListContent['email'],
            'action_url'       => $this->waitListContent['action_url'],
            'product_name' => env('APP_NAME')
        ]);
    }
}
