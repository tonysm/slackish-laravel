<?php

namespace Tests\Feature;

use App\Company;
use App\Events\ChannelCreated;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelsTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersCanListCompanyChannels()
    {
        factory(Company::class)->create();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->getJson('/api/channels');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                [
                    'id' => $user->currentChannel->id,
                    'name' => $user->currentChannel->name,
                ],
            ],
        ]);
        $this->assertCount(1, $response->json()['data']);
    }

    public function testUsersCanCreateChannelsOnTheirCompanies()
    {
        Event::fake();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/channels', [
                'name' => 'New Channel',
            ]);

        $channels = $user->currentCompany->channels;

        $response->assertStatus(201);
        $this->assertCount(2, $channels);
        Event::assertDispatched(ChannelCreated::class, function (ChannelCreated $event) use ($channels) {
            return $channels->contains($event->channel);
        });
    }
}
