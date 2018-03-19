<?php

namespace App\Events;

use App\Poem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PoemSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $poem;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Poem $poem)
    {
        $this->poem = $poem;
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
