<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use Illuminate\Support\Facades\Request as RequestFacade;

class MostLikedVideoController extends Controller
{
    public function __invoke()
    {
        $storeNumber = RequestFacade::segment(1);
        $mostLiked = Video::getMostLikedVideos($storeNumber);
        return view('site.video.liked')
            ->with('mostLiked', $mostLiked);
    }
}
