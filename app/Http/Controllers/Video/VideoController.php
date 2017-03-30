<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Video\Video;
use App\Models\Video\Tag;
use App\Models\Video\VideoTag;
use App\Models\Video\Playlist;


class VideoController extends Controller
{
    
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $featured = Video::getFeaturedVideo();
        $mostViewed = Video::getMostViewedVideos(12);
        $mostLiked = Video::getMostLikedVideos(4);
        $mostRecent = Video::getMostRecentVideos(12);
        $latestPlaylists = Playlist::getLatestPlaylists(3);

        return view('site.video.index')
            ->with('mostLiked', $mostLiked)
            ->with('mostRecent', $mostRecent)
            ->with('mostViewed', $mostViewed)
            ->with('latestPlaylists', $latestPlaylists)
            ->with('featured', $featured);
    }

    public function show(Request $request)
    {
        $video = Video::getSingleVideo($request->id);
        $playlists = Video::getPlaylistsThatContainSpecificVideo($request->id);

        return view('site.video.singlevideo')
            ->with('video', $video)
            ->with('playlists', $playlists);
    }


    public function showTag($tag)
    {
        return view('site.video.tag');
    }


}
