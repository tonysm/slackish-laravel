<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\Channels\SendMessageRequest;
use App\Events\NewMessage;
use Illuminate\Support\Carbon;

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
        ));

        return response()->json('', 201);
    }
}
