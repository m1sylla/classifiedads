<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmAdminSuccessEmail;
use App\Events\NewAdminConfirmedEvent;

class NewAdminConfirmedListener
{
    /**
     * Handle the event.
     *
     * @param  NewAdminConfirmedEvent  $event
     * @return void
     */
    public function handle(NewAdminConfirmedEvent $event)
    {
        Mail::to($event->admin->email)->send(new ConfirmAdminSuccessEmail($event->data));
    }
}
