<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Video\Playlist;
use App\Models\Video\PlaylistVideo;
use App\Models\Video\Video;

class PlaylistAdminController extends Controller
{

    /**
     * Instantiate a new PlaylistAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $playlists =Playlist::where('banner_id', $banner->id)
                    ->latest('created_at')
                    ->get();

        return view('admin.video.playlist-manager.index')
                ->with('playlists', $playlists)
                ->with('banners', $banners)
                ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $videos = Video::getAllVideos();
        return view('admin.video.playlist-manager.create')
                ->with('videos', $videos)
                ->with('banners', $banners)
                ->with('banner', $banner);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $playlist = Playlist::find($id);
        $videos = Video::getAllVideos();

        $selectedVideos = PlaylistVideo::where('playlist_id', $id)->orderBy('order')->get();


        foreach($selectedVideos as $sv){
            $video_info = Video::find($sv->video_id);
            $sv->title = $video_info->title;
            $sv->thumbnail =  $video_info->thumbnail;
        }

        return view('admin.video.playlist-manager.edit')
                ->with('playlist', $playlist)
                ->with('videos', $videos)
                ->with('playlist_videos', $selectedVideos)
                ->with('banners', $banners)
                ->with('banner', $banner);

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
