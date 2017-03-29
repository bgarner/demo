<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\Playlist;
use App\Models\Video\PlaylistVideo;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::getLatestPlaylists();
        return view('site.video.allPlaylists')
            ->with('playlists', $playlists);
    }

    public function show(Request $request)
    {
        $videoList = PlaylistVideo::getPlaylistVideos($request->id);
        $playlistMeta = Playlist::getPlaylistMetaData($request->id);

        return view('site.video.playlist')
            ->with('playlistMeta', $playlistMeta)
            ->with('videoList', $videoList);
    }
}
