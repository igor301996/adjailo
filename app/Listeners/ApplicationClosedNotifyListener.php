<?php

namespace App\Listeners;

use App\Events\ApplicationClosedEvent;
use App\Mail\Application\ClosedNotifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ApplicationClosedNotifyListener
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
     * @param ApplicationClosedEvent $event
     * @return void
     */
    public function handle(ApplicationClosedEvent $event)
    {
        $application = $event->application
            ->with('userClosed', 'manager')
            ->first();
        $closedUser = $application->userClosed;

        if ($closedUser->is_manager) {
            $userTo = $application->user;
        } else {
            $userTo = $application->manager;
        }

        if (!$application->manager) {
            return;
        }

        Mail::queue(new ClosedNotifyMail($userTo, $application));
    }
}
