<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;

class MostLikedVideoController extends Controller
{
    public function __invoke()
    {
        $mostLiked = Video::getMostLikedVideos();
        return view('site.video.liked')
            ->with('mostLiked', $mostLiked);
    }
}
