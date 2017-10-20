<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequiresCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testCompanyIsRequiredToUserTheApplication()
    {
        $user = factory(User::class)->states(['without_company'])->create();

        $response = $this->actingAs($user)
            ->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.create'));
    }
}
