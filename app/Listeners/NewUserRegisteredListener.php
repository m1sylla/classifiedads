<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmUserEmail;
use App\Events\NewUserRegisteredEvent;

class NewUserRegisteredListener
{ 
    
    /**
     * Handle the event.
     *
     * @param  NewUserRegisteredEvent  $event
     * @return void
     */
    public function handle(NewUserRegisteredEvent $event)
    {
        Mail::to($event->compte->email)->send(new ConfirmUserEmail($event->data));
    }
}
