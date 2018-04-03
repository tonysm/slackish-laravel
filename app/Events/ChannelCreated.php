<?php

namespace App\Events;

use App\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChannelCreated implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Channel
     */
    public $channel;

    /**
     * Create a new event instance.
     *
     * @param \App\Channel $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel("companies.{$this->channel->company_id}");
    }
}
