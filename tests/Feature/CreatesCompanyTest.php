<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatesCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersWithoutCompanyCanSeeCreationForm()
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

    public function testCreatingCompaniesShouldCreateTheFirstChannel()
    {
        $user = $this->createUserWithoutCompany();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => 'madewithlove',
            ]);

        $this->assertCount(1, $user->refresh()->currentCompany->channels);
    }

    /**
     * @param $companyName
     *
     * @dataProvider invalidCompanyNames
     */
    public function testValidationFailedWhenCreatingCompanies($companyName)
    {
        $user = $this->createUserWithoutCompany();

        $response = $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => $companyName,
            ]);

        $response->assertSessionHasErrors('name');
        $this->assertNull($user->refresh()->currentCompany);
    }

    public function invalidCompanyNames()
    {
        return [
            [''],
            [null],
            [str_random(256)],
        ];
    }
}