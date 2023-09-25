<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $username;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct($userna/me)
    public function __construct($message)

    {

        // $this->username = $username;
        // $this->message  = "{$username} liked your status";
        $this->message  = $message;

        // dd($message);
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['chat_channel'];
    }
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}
