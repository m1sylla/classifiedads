<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewAdEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //public $request, $ann;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request, $ann)
    {
        //$this->request = $request;
        //$this->ann = $ann;
    }

}
