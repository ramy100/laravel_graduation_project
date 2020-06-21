<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $route;
    public $time;

    public function __construct($message,$route,$time)
    {
        $this->message = $message;
        $this->route = $route;
        $this->time = $time;
    }

    public function broadcastOn()
    {
        return ['admin-channel'];
    }

    public function broadcastAs()
    {
        return 'admin-event';
    }
}
