<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Video\Tag;
use App\Models\Video\Video;
use App\Models\Video\VideoTag;
use App\Models\Utility\Utility;

class VideoAdminController extends Controller
{
    /**
     * Instantiate a new VideoAdminController instance.
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
        $videos = Video::getAllVideosForAdmin();

        return view('admin.video.video-manager.index')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packageHash = sha1(time() . time());
        $optGroupOptions = Utility::getStoreAndBannerSelectDropdownOptions();
        
        return view('admin.video.video-manager.video-upload')
            ->with('packageHash', $packageHash)
            ->with('optGroupOptions', $optGroupOptions);
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
        return;
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
        
        $videos = Video::where('upload_package_id', $package)->get();

        return view('admin.video.video-manager.video-add-meta-data')
                ->with('videos', $videos)
                ->with('banner', $banner);
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
        return redirect()->action('Video\VideoAdminController@index');;
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
        $video = Video::getVideoById($id);
        $optGroupOptions = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections = json_encode(Video::getSelectedStoresAndBannersByVideoId($id));
        $banners = UserBanner::getAllBanners()->pluck('name', 'id')->toArray();
        $tags = Tag::all()->pluck('name', 'id');

        return view('admin.video.video-manager.edit')->with('video', $video)
                                                    ->with('optGroupOptions', $optGroupOptions)
                                                    ->with('banners', $banners)
                                                    ->with('optGroupSelections', $optGroupSelections)
                                                    ->with('tags', $tags);
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
        $video = Video::find($id);
        
        return view('admin.video.video-manager.thumbnail-upload')
            ->with('video', $video)
            ->with('banner', $banner);
    }


    public function storeThumbnail($id, Request $request)
    {
        return Video::storeThumbnail($id, $request);
    }
}
