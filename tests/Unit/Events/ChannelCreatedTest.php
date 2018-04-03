<?php

namespace Tests\Unit\Events;

use App\Channel;
use Tests\TestCase;
use App\Events\ChannelCreated;
use Illuminate\Broadcasting\PresenceChannel;

class ChannelCreatedTest extends TestCase
{
    public function testBroadcastsProperly()
    {
        $channel = new Channel([
            'company_id' => 123,
        ]);

        $event = new ChannelCreated($channel);

        $broadcastingChannel = $event->broadcastOn();

        $this->assertInstanceOf(PresenceChannel::class, $broadcastingChannel);
        $this->assertEquals('presence-companies.123', $broadcastingChannel->name);
    }
}
