<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserPasswordResetEmail;
use App\Events\UserPasswordResetEvent;

class UserPasswordResetListener
{

    /**
     * Handle the event.
     *
     * @param  UserPasswordResetEvent  $event
     * @return void
     */
    public function handle(UserPasswordResetEvent $event)
    {
        Mail::to($event->to)->send( new UserPasswordResetEmail($event->data));
    }
}
