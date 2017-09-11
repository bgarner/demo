<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use App\Models\Validation\VideoValidator;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use Illuminate\Http\Request;
use App\Models\Video\VideoTag;
use App\Models\Utility\Utility;
use App\User;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use App\Models\Video\VideoTarget;
use App\Models\Video\VideoBanner;
use App\Models\StoreApi\StoreInfo;
use Illuminate\Pagination\LengthAwarePaginator;


class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';
    protected $fillable = ['upload_package_id', 'original_filename', 'original_extension', 'filename', 'title', 'description', 'uploader', 'likes', 'dislikes', 'featured', 'thumbnail', 'views', 'all_stores', 'start'];
    protected $dates = ['deleted_at'];

    public static function incrementViewCount($id)
    {
        $video = Video::find($id);
        $currentCount = $video->views;
        $updatedCount = $currentCount + 1;
	    $video->views = $updatedCount;
	    $video->save();
        return $updatedCount;
    }

    public static function incrementLikeCount($id)
    {
        $video = Video::find($id);
        $currentLikes = $video->likes;
        $updatedLikes = $currentLikes + 1;
        $video->likes = $updatedLikes;
        $video->save();
        return $updatedLikes;
    }

    public static function incrementDislikeCount($id)
    {
        $video = Video::find($id);
        $currentDislikes = $video->dislikes;
        $updatedDislikes = $currentDislikes + 1;
        $video->dislikes = $updatedDislikes;
        $video->save();
        return $updatedDislikes;
    }
    public static function validateCreateVideo($request)
    {
        \Log::info($request->all());
        $validateThis = [

            'filename'      => $request->file('document'),
            'start'         => $request->start,
            'target_stores' => explode(',', $request['target_stores'])

        ];
        if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

        \Log::info($validateThis);

        $v = new VideoValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;
    }

    public static function getAllVideosForAdmin()
    {
    	$banners = UserBanner::getAllBanners()->pluck('id')->toArray();
        
        //stores in accessible banners
        $storeList = [];
        foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        }

        $allStoreVideos = Video::join('video_banner', 'video_banner.video_id', '=', 'videos.id')
                                ->where('all_stores', 1)
                                ->whereIn('video_banner.banner_id', $banners)
                                ->select('videos.*', 'video_banner.banner_id')
                                ->get();

        $allStoreVideos = Video::groupBannersForAllStoreVideos($allStoreVideos);
        
        
        
        $targetedVideos = Video::join('video_target', 'video_target.video_id', '=', 'videos.id')
                                ->whereIn('video_target.store_id', $storeList)
                                ->select('videos.*', 'video_target.store_id')
                                ->get();

        $targetedVideos = Video::groupStoresForTargetedVideos($targetedVideos);

        $videos = Playlist::mergeTargetedAndAllStoreAssets($targetedVideos, $allStoreVideos);

        // $videos = $allStoreVideos->merge($targetedVideos)->sortByDesc('created_at');

        foreach ($videos as $video) {
            $video->uploaderFirstName = User::find($video->uploader)->firstname;
            $video->uploaderLastName  = User::find($video->uploader)->lastname;
            $video->link              = Utility::getModalLink($video->filename, $video->title, $video->original_extension, $video->id, 0);
            $video->link_with_icon    = Utility::getModalLink($video->filename, $video->title, $video->original_extension, $video->id, 1);
            $video->icon              = Utility::getIcon($video->original_extension);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
            $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
            $video->tags              = VideoTag::getTagsByVideoId($video->id);
        }
                        
                        
        return $videos;
    }

    public static function storeVideo($request)
    {
     	\Log::info($request->all());
        $validate = Video::validateCreateVideo($request);

        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }

        $metadata = Document::getDocumentMetaData($request->file('document'));

        $directory = public_path() . '/video';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        $banner = UserSelectedBanner::getBanner();

        if ($upload_success) {
            $documentdetails = array(
                'original_filename' => $metadata["originalName"],
                'filename'          => $filename,
                'original_extension'=> $metadata["originalExtension"],
                'upload_package_id' => $request->get('upload_package_id'),
                'title'             => preg_replace('/\.'.preg_quote($metadata["originalExtension"]).'/', '', $metadata["originalName"]),
                'description'       => "no description",
                'uploader'			=> \Auth::user()->id,
                'likes'				=> 0,
                'dislikes'			=> 0,
                'featured'			=> 0,
                'thumbnail'         => "video-placeholder_360.jpg",
                'start'             => $request['start']
            );

            $video = Video::create($documentdetails);
            $video->save();
            $lastInsertedId= $video->id;
            Video::updateTargetStores($request, $lastInsertedId);
        }

        return $video ;
    }

    public static function updateMetaData(Request $request, $id=null)
    {
        \Log::info($request->all());
        if (!isset($id)) {
            $id = $request->get('video_id');
        }

        $tags = $request->get('tags');
        if ($tags != null) {
            Video::updateTags($id, $tags);
        }

        $title          = $request->get('title');
        $description    = $request->get('description');
        $featured       = 0;

        $metadata = array(
            'title'       => $title,
            'description' => $description,
            'featured'    => $featured
        );

        $video = Video::find($id);
        $video->update($metadata);

        FeaturedVideo::updateFeaturedOn($id, $request);
        if(isset($request->target_banners) || isset($request->target_stores)){
            Video::updateTargetStores($request, $id);    
        }
        
        return $video;
    }

    public static function updateTags($id, $tags)
    {
        VideoTag::where('video_id', $id)->delete();
        foreach ($tags as $tag) {
            VideoTag::create([
               'video_id'     => $id,
               'tag_id'         => $tag
            ]);
        }

        return;
    }

    public static function getPlaylistsThatContainSpecificVideo($id)
    {
        $playlistMeta = [];

        $lists = PlaylistVideo::where('video_id', $id)->get();

        $i=0;
        foreach($lists as $list){
            $playlistMeta[$i] = Playlist::getPlaylistMetaData($list->playlist_id);
            $i++;
        }
        return $playlistMeta;
    }

    public static function getSingleVideo($id)
    {
        $video = Video::where('id', $id)
                ->get()
                ->each(function($video){
                    $totallikesdislikes = $video->likes + $video->dislikes;

                    if($totallikesdislikes > 0){
                        $ratio = ($video->likes / $totallikesdislikes) * 100;
                        $video->ratio = round( $ratio );
                    } else {
                        $video->ratio = 0;
                    }

                    $video->likes = number_format($video->likes);
                    $video->dislikes = number_format($video->dislikes);
                    //    $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
                    //    $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
                });

        //dd($video);
        return $video;
    }

    public static function getVideoById($id)
    {
        $video = Video::find($id);
        $video->tags = VideoTag::getTagsByVideoId($id);

        $featuredOnBanner = FeaturedVideo::getFeaturedBannerByVideoId($id);

        if(count($featuredOnBanner) > 0){
            $video->featured = 1;
            $featuredOn = [];
            foreach ($featuredOnBanner as $item) {
                array_push($featuredOn, $item->banner_id);
            }
            
            $video->featuredOn = $featuredOn;
        }
        return $video;
                    
    }

    public static function getMostLikedVideos($store_id, $limit=0)
    {
        if($limit == 0){
            $videos = Video::getVideosForStore($store_id)->sortByDesc('likes');
            $videos = Self::paginate($videos, 24)->setPath('liked');

        } else {
            $videos = Video::getVideosForStore($store_id)->sortByDesc('likes')->take($limit);
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
        }
        return $videos;
    }

    public static function getMostRecentVideos($store_id, $limit=0)
    {
        if($limit == 0){
            
            $videos = Video::getVideosForStore($store_id)->sortByDesc('created_at');
            $videos = Self::paginate($videos, 24)->setPath('latest');

        } else {
            $videos = Video::getVideosForStore($store_id)->sortByDesc('created_at')->take($limit);
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
        }

        return $videos;
    }
    public static function getMostViewedVideos($store_id, $limit=0)
    {
        if($limit == 0){
            $videos = Video::getVideosForStore($store_id)->sortByDesc('views');
            $videos = Self::paginate($videos, 24)->setPath('popular');

        } else {
            $videos = Video::getVideosForStore($store_id)->sortByDesc('views')->take($limit);
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
        }

        return $videos;
    }

    public static function getVideosForStore($store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        $allStoreVideosForBanners = Video::join('video_banner', 'videos.id', '=', 'video_banner.video_id' )          
                                            ->where('videos.all_stores', 1)
                                            ->where('video_banner.banner_id', $banner_id)
                                            ->select('videos.*')
                                            ->get();

        $targetedVideosForStore = Video::join('video_target', 'video_target.video_id', '=', 'videos.id')
                                        ->where('video_target.store_id', $store_id)
                                        ->select('videos.*')
                                        ->get();
        $videos = $targetedVideosForStore->merge($allStoreVideosForBanners);
        
        return $videos;
    }


    public static function getVideosByUploader($uploaderId)
    {
        return Video::where('uploader', $uploaderId)->orderBy('created_at', 'desc')->get();
    }

    public static function getVideosByTag($tagId)
    {
        $videos = Video::join('video_tags', 'video_tags.video_id', '=', 'videos.id')
                        ->where('video_tags.tag_id', $tagId)
                        ->where('video_tags.deleted_at', '=', null)
                        ->select('videos.*')
                        ->get();
        return $videos;
    }

    public static function getVideoThumbnail($id)
    {
        $video = Video::find($id);
        $thumbnail = $video->thumbnail;
        return $thumbnail;
    }

    public static function getRelatedVideos($id)
    {

    }

    public static function generateThumbnail($id)
    {
        $video = Video::find($id);

        $thumbnailFilename = $video->filename . ".jpg";
        $sourcePath = public_path()."/video/". $video->filename;
        $destinationPath = public_path().'/video/thumbs/'. $thumbnailFilename;


        $ffprobe = FFProbe::create();
        $duration = $ffprobe
                            ->format($sourcePath) // extracts file informations
                            ->get('duration');


        $ffmpeg =  FFMpeg::create();
        $videoFile = $ffmpeg->open( $sourcePath);
        $frame = $videoFile->frame(TimeCode::fromSeconds(ceil($duration/2)));
        $frame->save( $destinationPath );

        $video->update(['thumbnail' => $thumbnailFilename]);
        return $video;
    }


    public static function storeThumbnail($video_id, $request)
    {
        $metadata = Document::getDocumentMetaData($request->file('document'));

        $directory = public_path() . '/video/thumbs';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        Video::find($video_id)->update(['thumbnail'=>$filename]);

        return;
    }

    public static function updateTargetStores($request, $id)
    {

        $all_stores = $request['all_stores'];

        $video = Video::find($id);
        if(VideoBanner::where('video_id', $id)->exists()){
            VideoBanner::where('video_id', $id)->delete();    
        }

        if( VideoTarget::where('video_id', $id)->exists()){
            VideoTarget::where('video_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){
            $video->all_stores = 1;
            $video->save();
            $target_banners = $request['target_banners'];
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            
            foreach ($target_banners as $key=>$banner) {
                VideoBanner::create([
                'video_id' => $id,
                'banner_id' => $banner
                ]);
                
            }
            
            
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                VideoTarget::insert([
                    'video_id' => $id,
                    'store_id' => $store
                    ]);    
            }
            
        }  
        return;         
    }

   

    public static function groupBannersForAllStoreVideos($allStoreVideos)
    {
        $allStoreVideos = $allStoreVideos->toArray();
        $compiledVideos = [];
        foreach ($allStoreVideos as $video) {
            $index = array_search($video['id'], array_column($compiledVideos, 'id'));
            if(  $index !== false ){
               array_push($compiledVideos[$index]->banners, $video["banner_id"]);
            }
            else{
               
               $video["banners"] = [];
               array_push( $video["banners"] , $video["banner_id"]);
               array_push( $compiledVideos , (object) $video);
            }

        }
        
        return collect($compiledVideos);
    }



    public static function groupStoresForTargetedVideos($targetedVideos)
    {
        $targetedVideos = $targetedVideos->toArray();
        $compiledVideos = [];
        foreach ($targetedVideos as $video) {
            $index = array_search($video['id'], array_column($compiledVideos, 'id'));
            if(  $index !== false ){
               array_push($compiledVideos[$index]->stores, $video["store_id"]);
            }
            else{
               
               $video["stores"] = [];
               array_push( $video["stores"] , $video["store_id"]);
               array_push( $compiledVideos , (object) $video);
            }

        }
        
        return collect($compiledVideos);
    }



    /**
     * Create a length aware custom paginator instance.
     *
     * @param  Collection  $items
     * @param  int  $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginate($items, $perPage = 12)
    {
        //Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Slice the collection to get the items to display in current page
        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);

        //Create our paginator and pass it to the view
        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }

    public static function getSelectedStoresAndBannersByVideoId($video_id)
    {
        $targetBanners = VideoBanner::where('video_id', $video_id)->get()->pluck('banner_id')->toArray();
        $targetStores = VideoTarget::where('video_id', $video_id)->get()->pluck('store_id')->toArray();

        $optGroupSelections = array_merge($targetBanners, $targetStores );
        return( $optGroupSelections );
    }


}
