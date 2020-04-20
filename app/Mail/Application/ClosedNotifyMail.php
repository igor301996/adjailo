<?php

namespace App\Mail\Application;

use App\Application;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClosedNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $userTo;
    /**
     * @var Application
     */
    public $application;

    /**
     * Create a new message instance.
     *
     * @param User $userTo
     * @param Application $application
     */
    public function __construct(User $userTo, Application $application)
    {
        $this->userTo = $userTo;
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->userTo)
            ->view('mail.application.closed');
    }
}
