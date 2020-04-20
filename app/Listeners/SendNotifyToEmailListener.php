<?php

namespace App\Listeners;

use App\Events\MessageCreatedEvent;
use App\Mail\Message\SendNotifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotifyToEmailListener
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
     * @param MessageCreatedEvent $event
     * @return void
     */
    public function handle(MessageCreatedEvent $event)
    {
        $userFrom = $event->user;
        $application = $event->application;

        if ($userFrom->is_manager) {
            $userTo = $application->user;
        } else {
            $userTo = $application->manager;
        }

        Mail::queue(new SendNotifyMail($userFrom, $userTo, $application));
    }
}
