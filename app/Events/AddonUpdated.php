<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddonUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $addon = NULL;
    public $revision = NULL;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($addon, $revision)
    {
        $this->addon = $addon;
        $this->revision = $revision;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
