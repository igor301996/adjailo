<?php

namespace App\Mail\Message;

use App\Application;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $userFrom;
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
     * @param User $userFrom
     * @param User $userTo
     * @param Application $application
     */
    public function __construct(User $userFrom, User $userTo, Application $application)
    {
        $this->userFrom = $userFrom;
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
        $applicationMessage = $this->application->messages()->latest()->first();

        return $this->to($this->userTo)
            ->view('mail.message.send_notify')
            ->with(compact('applicationMessage'));
    }
}
