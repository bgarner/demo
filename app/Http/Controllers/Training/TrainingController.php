<?php

namespace App\Http\Controllers\Training;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Models\Video\Playlist;
use App\Models\Video\PlaylistVideo;

class TrainingController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);
    }

    public function index(Request $request)
    {
    	$videoList = PlaylistVideo::getPlaylistVideos(63);
        return view('site.training.index')
        	->with('videoList', $videoList);
    }    
}
