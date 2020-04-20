<?php

namespace App\Providers;

use App\Events\ApplicationClosedEvent;
use App\Events\ApplicationCreatedEvent;
use App\Events\MessageCreatedEvent;
use App\Listeners\ApplicationClosedNotifyListener;
use App\Listeners\SendMessageManagersListener;
use App\Listeners\SendNotifyToEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ApplicationCreatedEvent::class => [
            SendMessageManagersListener::class
        ],
        ApplicationClosedEvent::class => [
            ApplicationClosedNotifyListener::class
        ],
        MessageCreatedEvent::class => [
            SendNotifyToEmailListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
