<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    private const PER_PAGE = 10;
    public function show(Channel $channel)
    {
        $videos = $channel->videos()->paginate(self::PER_PAGE);

        return view('channels.show', [
            'channel' => $channel->load('videos'),
            'videos' => $videos
        ]);
    }
}