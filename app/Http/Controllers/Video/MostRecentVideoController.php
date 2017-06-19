<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use Illuminate\Support\Facades\Request as RequestFacade;

class MostRecentVideoController extends Controller
{
    public function __invoke()
    {
        $storeNumber = RequestFacade::segment(1);
        $mostRecent = Video::getMostRecentVideos($storeNumber);
        return view('site.video.latest')
            ->with('mostRecent', $mostRecent);

    }
}
