<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;

class MostRecentVideoController extends Controller
{
    public function __invoke()
    {
        $mostRecent = Video::getMostRecentVideos();
        return view('site.video.latest')
            ->with('mostRecent', $mostRecent);

    }
}
