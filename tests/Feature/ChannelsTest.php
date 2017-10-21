<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Support\Facades\Broadcast;
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
        Broadcast::shouldReceive('event')->once();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/channels', [
                'name' => 'New Channel',
            ]);

        $response->assertStatus(201);
        $this->assertCount(2, $user->currentCompany->channels);
    }
}
