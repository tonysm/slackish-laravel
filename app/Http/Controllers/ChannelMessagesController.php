<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\Channels\SendMessageRequest;
use App\Notifications\Channels\NewMessage;
use Carbon\Carbon;

class ChannelMessagesController extends Controller
{
    /**
     * @param \App\Http\Requests\Channels\SendMessageRequest $request
     * @param \App\Channel $channel
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SendMessageRequest $request, Channel $channel)
    {
        broadcast(new NewMessage(
            $request->user(),
            $channel,
            $request->input('content'),
            $request->input('uuid'),
            Carbon::now()
        ))->toOthers();

        return response()->json('', 201);
    }
}
