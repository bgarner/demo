<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Models\Video\Tag;
use App\Models\Video\Video;
use App\Models\Video\VideoTag;

class VideoAdminController extends Controller
{
    /**
     * Instantiate a new VideoAdminController instance.
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
        $videos = Video::getAllVideos();
        $banner = UserSelectedBanner::getBanner();
        
        $banners = Banner::all();

        return view('admin.video.video-manager.index')->with('banner', $banner)
                                        ->with('banners', $banners)
                                        ->with('videos', $videos);
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
        $packageHash = sha1(time() . time());
        
        return view('admin.video.video-manager.video-upload')
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('banners', $banners); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Video::storeVideo($request);
    }
    /**
     * Show form to updata meta data for specific group of files.
     *
     * @param  Request $request
     * @return Response
     */
    public function showMetaDataForm(Request $request)
    {
        $package = $request->get('package');

        $banner = UserSelectedBanner::getBanner();
        
        $banners = Banner::all();
        
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        
        $videos = Video::where('upload_package_id', $package)->get();

        return view('admin.video.video-manager.video-add-meta-data')
                ->with('videos', $videos)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('tags', $tags);
            
    }    

    /**
     * Updata meta data for specific files.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateMetaData(Request $request)
    {
        Video::updateMetaData($request);
        return;
    }       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $banner = UserSelectedBanner::getBanner();
        
        $banners = Banner::all();
        
        $selected_tags = VideoTag::where('video_id', $id)
                                ->join('tags', 'tags.id', '=', 'video_tags.tag_id')
                                ->select('tags.*')
                                ->get()
                                ->pluck('id')->toArray();
                                        
        $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        return view('admin.video.video-manager.edit')->with('video', $video)
                                                    ->with('banner', $banner)
                                                    ->with('banners', $banners)
                                                    ->with('tags', $tags)
                                                    ->with('selected_tags', $selected_tags);
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
        Video::updateMetaData($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::where('id', $id)->delete();
        VideoTag::where('video_id', $id)->delete();
        return;
    }

    public function generateThumbnail($id)
    {
        return Video::generateThumbnail($id);
    }


    public function uploadThumbnail($id)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();     
        $video = Video::find($id);
        
        return view('admin.video.video-manager.thumbnail-upload')
            ->with('video', $video)
            ->with('banner', $banner)
            ->with('banners', $banners); 
    }


    public function storeThumbnail($id, Request $request)
    {
        return Video::storeThumbnail($id, $request);
    }
}
