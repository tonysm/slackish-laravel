<?php

namespace App\Events;

use App\Channel;
use App\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class NewMessage implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Channel
     */
    public $channel;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $uuid;

    /**
     * @var \Illuminate\Support\Carbon
     */
    public $sentAt;

    /**
     * Create a new notification instance.
     *
     * @param \App\User $user
     * @param \App\Channel $channel
     * @param string $content
     * @param string $uuid
     * @param \Illuminate\Support\Carbon $sentAt
     */
    public function __construct(User $user, Channel $channel, string $content, string $uuid, Carbon $sentAt)
    {
        $this->user = $user;
        $this->channel = $channel;
        $this->content = $content;
        $this->uuid = $uuid;
        $this->sentAt = $sentAt;
    }

    /**
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel( "channels.{$this->channel->id}");
    }
}
