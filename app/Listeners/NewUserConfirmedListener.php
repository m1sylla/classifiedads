<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\NewUserConfirmedEvent;
use App\Mail\ConfirmUserSuccessEmail;
use Illuminate\Support\Facades\Mail; 

class NewUserConfirmedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserConfirmedEvent $event)
    {
        Mail::to($event->to)->send(new ConfirmUserSuccessEmail());
    }
}
