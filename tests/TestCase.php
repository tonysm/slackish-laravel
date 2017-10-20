<?php

namespace Tests;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param array $overrides
     *
     * @return User
     */
    protected function createUser(array $overrides = [])
    {
        /** @var User $user */
        $user = factory(User::class)
            ->create($overrides);

        $company = factory(Company::class)
            ->create(['owner_id' => $user->id]);

        $user->currentCompany()->associate($company);
        $user->save();

        return $user;
    }

    /**
     * @param array $overrides
     *
     * @return User
     */
    protected function createUserWithoutCompany(array $overrides = [])
    {
        return factory(User::class)
            ->create($overrides);
    }
}
