<?php

namespace App\Listeners;

use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\Mail;
use App\Events\PasswordResetRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordResetEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordResetRequested $event)
    {
        Mail::to($event->user->email)->send(new PasswordResetEmail($event->user, $event->token));
    }
}
