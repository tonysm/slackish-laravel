<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannelCollection;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index(Request $request)
    {
        return ChannelCollection::make($request->user()->currentCompany->channels);
    }
}
