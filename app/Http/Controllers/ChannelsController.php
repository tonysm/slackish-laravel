<?php

namespace App\Http\Controllers;

use App\Events\ChannelCreated;
use App\Http\Requests\Channels\CreateChannelRequest;
use App\Http\Resources\ChannelCollection;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return ChannelCollection::make($request->user()->currentCompany->channels);
    }

    /**
     * @param \App\Http\Requests\Channels\CreateChannelRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateChannelRequest $request)
    {
        $channel = $request->user()->currentCompany->createChannel($request->name);

        broadcast(new ChannelCreated($channel));

        return response()->json('', 201);
    }
}
