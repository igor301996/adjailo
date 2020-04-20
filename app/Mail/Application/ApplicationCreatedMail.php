<?php

namespace App\Mail\Application;

use App\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Application
     */
    public $application;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->user = $application->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.application.created');
    }
}
