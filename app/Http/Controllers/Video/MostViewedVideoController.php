<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;

class MostViewedVideoController extends Controller
{
    public function __invoke()
    {
        $mostViewed = Video::getMostViewedVideos();
        return view('site.video.popular')
            ->with('mostViewed', $mostViewed);
    }
}
