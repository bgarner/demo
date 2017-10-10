<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use App\Models\Validation\VideoValidator;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use Illuminate\Http\Request;
use App\Models\Tag\ContentTag;
use App\Models\Utility\Utility;
use App\User;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use App\Models\Video\VideoTarget;
use App\Models\Video\VideoBanner;
use App\Models\Video\VideoStoreGroup;
use App\Models\StoreApi\StoreInfo;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Tools\CustomStoreGroup;


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
            'start'         => $request->start
            // 'target_stores' => explode(',', $request['target_stores'])

        ];

        if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banner'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['target_store_groups'] != NULL) {
            $validateThis['target_store_groups'] = $request['target_store_groups'];
        }

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

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $videosForStoreGroups = Video::join('video_store_group', 'video_store_group.video_id', '=', 'videos.id')
                                            ->whereIn('video_store_group.store_group_id', $storeGroups)
                                            ->select('videos.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = VideoStoreGroup::where('video_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });

        $targetedVideos = Video::mergeTargetedAndStoreGroupVideos($targetedVideos, $videosForStoreGroups);
                                           
        $videos = Playlist::mergeTargetedAndAllStoreAssets($targetedVideos, $allStoreVideos);

        foreach ($videos as $video) {
            $video->uploaderFirstName = User::find($video->uploader)->firstname;
            $video->uploaderLastName  = User::find($video->uploader)->lastname;
            $video->link              = Utility::getModalLink($video->filename, $video->title, $video->original_extension, $video->id, 0);
            $video->link_with_icon    = Utility::getModalLink($video->filename, $video->title, $video->original_extension, $video->id, 1);
            $video->icon              = Utility::getIcon($video->original_extension);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
            $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
            $video->tags              = ContentTag::getTagsByContentId( 'video', $video->id);
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
            VideoTarget::updateTargetStores($request, $lastInsertedId);
        }

        return $video ;
    }

    public static function updateMetaData(Request $request, $id=null)
    {
        \Log::info($request->all());
        if (!isset($id)) {
            $id = $request->get('video_id');
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
            VideoTarget::updateTargetStores($request, $id);    
        }

        $tags = $request->get('tags');
        ContentTag::updateTags( 'video', $id, $tags);
        
        return $video;
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
        $video->tags = ContentTag::getTagsByContentId('video', $id);
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

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);

        $targetedVideosForStoreGroups = Video::join('video_store_group', 'video_store_group.video_id', '=', 'videos.id')
                                            ->whereIn('video_store_group.store_group_id', $storeGroups)
                                            ->select('videos.*')
                                            ->get();

        $videos = $targetedVideosForStore->merge($allStoreVideosForBanners);
        $videos = $videos->merge($targetedVideosForStoreGroups);
        
        return $videos;
    }


    public static function getVideosByUploader($uploaderId)
    {
        return Video::where('uploader', $uploaderId)->orderBy('created_at', 'desc')->get();
    }

    public static function getVideosByTag($tagId)
    {
        $videos = Video::join('content_tag', 'content_tag.content_id', '=', 'videos.id')
                        ->where('content_type', 'video')
                        ->where('content_tag.tag_id', $tagId)
                        ->where('content_tag.deleted_at', '=', null)
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

    public static function mergeTargetedAndStoreGroupVideos($targetedVideos, $storeGroupVideos)
    {
        $targetedVideosArray = $targetedVideos->toArray();
        $targetedVideoIds = array_column($targetedVideosArray, 'id');
        foreach ($storeGroupVideos as $video) {

            if(in_array($video->id, $targetedVideoIds)){
                $targetedVideoStores = $targetedVideos->where('id', $video->id)->first()->stores;
                $mergedStores = array_merge( $targetedVideoStores, $video->stores);
                $targetedVideos->where('id', $video->id)->first()->stores = $mergedStores;
            }
            else{

                $targetedVideos = $targetedVideos->push((object)$video);                
            }
        }
        return $targetedVideos;

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
        $storeGroups = VideoStoreGroup::where('video_id', $video_id)->get()->pluck('store_group_id')->toArray();

        $optGroupSelections = [];
        foreach ($targetBanners as $banner) {
            array_push($optGroupSelections, 'banner'.$banner);
        }
        foreach ($targetStores as $stores) {
            array_push($optGroupSelections, 'store'.$stores);   
        }
        foreach ($storeGroups as $group) {
            array_push($optGroupSelections, 'storegroup'.$group);   
        }

        return( $optGroupSelections );
    }


}
