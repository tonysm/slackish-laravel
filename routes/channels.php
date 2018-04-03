<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channels.{channel}', function (\App\User $user, \App\Channel $channel) {
    if (!$channel->exists || !$user->canJoin($channel)) {
        return false;
    }

    $user->joinChannel($channel);

    return [
        'id' => $user->id,
        'name' => $user->name,
        'avatar_path' => $user->avatar_path,
        'joined_at' => now(),
    ];
});

Broadcast::channel('companies.{company}', function (\App\User $user, \App\Company $company) {
    if (!$user->currentCompany || !$user->currentCompany->is($company)) {
        return false;
    }

    return [
        'id' => $user->id,
        'name' => $user->name,
        'avatar_path' => $user->avatar_path,
        'joined_at' => now(),
    ];
});
