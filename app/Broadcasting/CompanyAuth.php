<?php

namespace App\Broadcasting;

use App\User;
use App\Company;

class CompanyAuth
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param Company $company
     * @return array|bool
     */
    public function join(User $user, Company $company)
    {
        if (!$user->currentCompany || !$user->currentCompany->is($company)) {
            return false;
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar_path' => $user->avatar_path,
            'joined_at' => now(),
        ];
    }
}
