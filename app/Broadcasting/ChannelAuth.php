<?php

namespace App\Broadcasting;

use App\User;
use App\Channel;

class ChannelAuth
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param Channel $channel
     * @return array|bool
     */
    public function join(User $user, Channel $channel)
    {
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
    }
}
