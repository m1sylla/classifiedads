<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewAdminRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $admin;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($admin, $data)
    {
        $this->admin = $admin;
        $this->data = $data;
    }
}
