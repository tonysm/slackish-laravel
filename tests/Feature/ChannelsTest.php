<?php

namespace Tests\Feature;

use App\Company;
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
}
