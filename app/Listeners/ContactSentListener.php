<?php

namespace App\Listeners;

use App\Events\ContactEmailSentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ContactSentListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ContactEmailSentEvent  $event
     * @return void
     */
    public function handle(ContactEmailSentEvent $event)
    {

    }
}
