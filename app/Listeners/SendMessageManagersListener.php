<?php

namespace App\Listeners;

use App\Events\ApplicationCreatedEvent;
use App\Mail\Application\ApplicationCreatedMail;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMessageManagersListener
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
     * @param ApplicationCreatedEvent $event
     * @return void
     */
    public function handle(ApplicationCreatedEvent $event)
    {
        $application = $event->application;
        $managers = User::where('is_manager', true)->get();

        Mail::to($managers)->queue(new ApplicationCreatedMail($application));
    }
}
