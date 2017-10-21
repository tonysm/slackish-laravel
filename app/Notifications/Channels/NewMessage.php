<?php

namespace App\Notifications\Channels;

use App\Channel;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification implements ShouldBroadcast
{
    use Queueable;

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
     * @var \Carbon\Carbon
     */
    public $sentAt;

    /**
     * Create a new notification instance.
     *
     * @param \App\User $user
     * @param \App\Channel $channel
     * @param string $content
     * @param string $uuid
     * @param \Carbon\Carbon $sentAt
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * @return string
     */
    public function broadcastOn()
    {
        return "channels.{$this->channel->id}";
    }
}
