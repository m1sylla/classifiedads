<?php

namespace App\Providers;

use App\Events\NewUserRegisteredEvent;
use App\Events\NewUserConfirmedEvent; 
use App\Events\UserPasswordResetEvent;

use App\Events\NewAdminRegisteredEvent;
use App\Events\NewAdminConfirmedEvent; 
use App\Events\AdminPasswordResetEvent;
//use App\Events\NewAdEvent;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*Illuminate\Mail\Events\MessageSending::class => [
            \App\Listeners\NewUserRegisteredListener::class,
        ],
        Illuminate\Mail\Events\MessageSent::class => [
            \App\Listeners\NewUserRegisteredListener::class,
        ],

        Illuminate\Mail\Events\MessageSending::class => [
            \App\Listeners\NewUserConfirmedListener::class,
        ],
        Illuminate\Mail\Events\MessageSent::class => [
            \App\Listeners\NewUserConfirmedListener::class,
        ],*/

        NewUserRegisteredEvent::class => [
            \App\Listeners\NewUserRegisteredListener::class,
        ],
        NewUserConfirmedEvent::class => [
            \App\Listeners\NewUserConfirmedListener::class,
        ],
        UserPasswordResetEvent::class => [
            \App\Listeners\UserPasswordResetListener::class,
        ],
        NewAdminRegisteredEvent::class => [
            \App\Listeners\NewAdminRegisteredListener::class,
        ],
        NewAdminConfirmedEvent::class => [
            \App\Listeners\NewAdminConfirmedListener::class,
        ],
        AdminPasswordResetEvent::class => [
            \App\Listeners\AdminPasswordResetListener::class,
        ],
        NewAdEvent::class => [
            \App\Listeners\AddPhotoListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
