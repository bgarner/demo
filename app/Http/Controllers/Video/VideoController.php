<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Video\Video;
use App\Models\Video\Playlist;
use App\Models\Video\FeaturedVideo;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tag\ContentTag;
use App\Models\Tag\Tag;


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

        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $featured = FeaturedVideo::getFeaturedVideoByBanner($storeBanner);
        //$mostViewed = Video::getMostViewedVideos($storeNumber, 12);
        //$mostLiked = Video::getMostLikedVideos($storeNumber, 4);
        $mostRecent = Video::getMostRecentVideos($storeNumber, 12);
        $latestPlaylists = Playlist::getLatestPlaylists($storeNumber, 3);
        $trending = Video::getTrendingVideos($storeNumber);

        return view('site.video.index')
            // ->with('mostLiked', $mostLiked)
            ->with('mostRecent', $mostRecent)
            // ->with('mostViewed', $mostViewed)
            ->with('trending', $trending)
            ->with('latestPlaylists', $latestPlaylists)
            ->with('featured', $featured);
    }

    public function show(Request $request)
    {
        $video = Video::getSingleVideo($request->id);
        $playlists = Video::getPlaylistsThatContainSpecificVideo($request->id);
        $tags = ContentTag::getTagsForContent("video", $request->id);

        return view('site.video.singlevideo')
            ->with('video', $video)
            ->with('tags', $tags)
            ->with('playlists', $playlists);
    }


    public function showTag($tag)
    {
        return view('site.video.tag');
    }


}
