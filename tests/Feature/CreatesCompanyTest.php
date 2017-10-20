<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatesCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersWithoutCompanyCanCreateOne()
    {
        $user = $this->createUserWithoutCompany();

        $response = $this->actingAs($user)
            ->get(route('companies.create'));

        $response->assertStatus(200);
    }

    public function testUsersWithCompanyCannotCreateOne()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)
            ->get(route('companies.create'));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    public function testUserWithoutCompanyCanCreateCompany()
    {
        $user = $this->createUserWithoutCompany();

        $response = $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => 'madewithlove',
            ]);

        $response->assertRedirect(route('home'));
        $this->assertNotNull($user->refresh()->company_id);
        $this->assertNotNull($user->currentCompany);
    }
}