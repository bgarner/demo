<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use Illuminate\Support\Facades\Request as RequestFacade;

class TrendingVideoController extends Controller
{
    public function __invoke()
    {
        $storeNumber = RequestFacade::segment(1);
        $trending = Video::getTrendingVideos($storeNumber, 12);
        return view('site.video.trending')
            ->with('trending', $trending);
    }
}