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
use App\Models\StoreInfo;


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

    public static function getAllVideos()
    {
    	$videos = Video::all()
                        ->each(function($file){
                            $file->uploaderFirstName = User::find($file->uploader)->firstname;
                            $file->uploaderLastName  = User::find($file->uploader)->lastname;
                            $file->link              = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 0);
                            $file->link_with_icon    = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 1);
                            $file->icon              = Utility::getIcon($file->original_extension);
                            $file->prettyDateCreated = Utility::prettifyDate($file->created_at);
                            $file->prettyDateUpdated = Utility::prettifyDate($file->updated_at);
                        })
                        ->sortByDesc('created_at');
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
            Self::updateTargetStores($request, $lastInsertedId);
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
        if ( null !== $request->get('featured') ) {
            Video::removeFeaturedVideoFlag();
            $featured = $request->get('featured');
        }


        $metadata = array(
            'title'       => $title,
            'description' => $description,
            'featured'    => $featured
        );

        $video = Video::find($id);
        $video->update($metadata);

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

    public static function removeFeaturedVideoFlag()
    {
        $featuredVideo = Video::where('featured', 1)->first();
        if( $featuredVideo !== null )
        {
            $featuredVideo->featured = 0;
            $featuredVideo->save();
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

    public static function getFeaturedVideo()
    {
        $video = Video::where('featured', 1)->first();
        if(count($video) > 0){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
        }
        return $video;
    }

    public static function getMostLikedVideos($limit=0)
    {
        if($limit == 0){
            $videos = Video::orderBy('likes', 'desc')->paginate(24);
        } else {
            $videos = Video::orderBy('likes', 'desc')->take($limit)->get();
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateUpdated = Utility::prettifyDate($video->updated_at);
        }
        return $videos;
    }

    public static function getMostRecentVideos($limit=0)
    {
        if($limit == 0){
            $videos = Video::orderBy('created_at', 'desc')->paginate(24);
        } else {
            $videos = Video::orderBy('created_at', 'desc')->take($limit)->get();
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
        }

        return $videos;
    }
    public static function getMostViewedVideos($limit=0)
    {
        if($limit == 0){
            $videos = Video::orderBy('views', 'desc')->paginate(24);
        } else {
            $videos = Video::orderBy('views', 'desc')->take($limit)->get();
        }

        foreach($videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
        }

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
        if( $all_stores == 'on' ){

            VideoTarget::where('video_id', $id)->delete();
            $target_banners = $request['target_banners'];
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $banner) {
                VideoBanner::create([
                'video_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $video->all_stores = 1;
            $video->save();
        }
        else{
            if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
                VideoTarget::where('video_id', $id)->delete();
                VideoBanner::where('video_id', $id)->delete();
                $video->all_stores = 0;
                $video->save();
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
        }
        return;         
    }

    public static function getStoreListForAdmin()
    {
        $banners = UserBanner::getAllBanners();
        $storeList = [];

        foreach ($banners as $banner) {
            
            $storeInfo = StoreInfo::getStoresInfo($banner->id);
            foreach ($storeInfo as $store) {
                $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner->name .")" ;
            }
            
        }
        
        return $storeList;
    }
}
