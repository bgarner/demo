<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\Banner;
use App\Models\Video\Playlist;
use App\Models\Video\PlaylistVideo;
use App\Models\Video\Video;
use App\Models\Utility\Utility;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;

class PlaylistAdminController extends Controller
{

    /**
     * Instantiate a new PlaylistAdminController instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $playlists = Playlist::getPlaylistsForAdmin();

        return view('admin.video.playlist-manager.index')
                ->with('playlists', $playlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $optGroupOptions    = Utility::getStoreAndBannerSelectDropdownOptions($allAccessibleBanners = true);
        $optGroupSelections = json_encode([]);
        $videos             = Video::getAllVideosForAdmin();
        $tags               = Tag::all()->pluck('name', 'id');
        $selected_tags      = [];
        return view('admin.video.playlist-manager.create')
                ->with('videos', $videos)
                ->with('optGroupSelections', $optGroupSelections)
                ->with('optGroupOptions', $optGroupOptions)
                ->with('tags', $tags)
                ->with('selected_tags', $selected_tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());
        return Playlist::storePlaylist($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $playlist           = Playlist::getPlaylistById($id);
        $videos             = Video::getAllVideosForAdmin();

        $selectedVideos     = PlaylistVideo::getPlaylistVideos($id);

        $optGroupOptions    = Utility::getStoreAndBannerSelectDropdownOptions($allAccessibleBanners = true);
        $optGroupSelections = json_encode(Playlist::getSelectedStoresAndBannersByPlaylistId($id));

        $tags               = Tag::all()->pluck('name', 'id');

        $selectedTags       = ContentTag::getTagsByContentId('playlist', $id);


        return view('admin.video.playlist-manager.edit')
                ->with('playlist', $playlist)
                ->with('videos', $videos)
                ->with('playlist_videos', $selectedVideos)
                ->with('optGroupOptions', $optGroupOptions)
                ->with('optGroupSelections', $optGroupSelections)
                ->with('tags', $tags)
                ->with('selectedTags', $selectedTags)
                ->with('resourceId', $id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Playlist::updatePlaylist($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Playlist::where('id', $id)->delete();
        PlaylistVideo::where('playlist_id', $id)->delete();
        return;
    }

    public function getPlaylistVideoPartial($id)
    {
        $videos = PlaylistVideo::getPlaylistVideos($id);
        return view('admin.video.playlist-manager.playlist-videos-partial')->with('videos', $videos);
    }
}
