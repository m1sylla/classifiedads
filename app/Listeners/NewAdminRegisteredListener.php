<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmAdminEmail;
use App\Events\NewAdminRegisteredEvent;

class NewAdminRegisteredListener
{
    
    /**
     * Handle the event.
     *
     * @param  NewAdminRegisteredEvent  $event
     * @return void
     */
    public function handle(NewAdminRegisteredEvent $event)
    {
        Mail::to($event->admin->email)->send(new ConfirmAdminEmail($event->data));
    }
}
