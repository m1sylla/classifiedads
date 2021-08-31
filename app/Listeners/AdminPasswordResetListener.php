<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\AdminPasswordResetEmail;
use App\Events\AdminPasswordResetEvent;

class AdminPasswordResetListener
{
    /**
     * Handle the event.
     *
     * @param  AdminPasswordResetEvent  $event
     * @return void
     */
    public function handle(AdminPasswordResetEvent $event)
    {
        Mail::to($event->to)->send( new AdminPasswordResetEmail($event->data));
    }
}
