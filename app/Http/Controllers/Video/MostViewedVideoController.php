<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use Illuminate\Support\Facades\Request as RequestFacade;

class MostViewedVideoController extends Controller
{
    public function __invoke()
    {
        $storeNumber = RequestFacade::segment(1);
        $mostViewed = Video::getMostViewedVideos($storeNumber);
        return view('site.video.popular')
            ->with('mostViewed', $mostViewed);
    }
}
