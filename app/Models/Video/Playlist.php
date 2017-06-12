<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;
use App\Models\Validation\PlaylistValidator;
use App\Models\Validation\PlaylistEditValidator;
use App\Models\Video\Video;
use App\Models\Video\PlaylistVideo;
use App\Models\Video\PlaylistBanner;
use App\Models\Video\PlaylistTarget;

class Playlist extends Model
{
    use SoftDeletes;

    protected $table = 'playlists';
    protected $fillable = ['title', 'all_stores', 'description'];
    protected $dates = ['deleted_at'];

    public static function validateCreatePlaylist($request)
    {
        \Log::info($request->all());
        $validateThis = [

            'title'  => $request['title'],
            'playlist_videos' => $request['playlist_videos']

        ];

        \Log::info($validateThis);

        $v = new PlaylistValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;
    }

    public static function validateEditPlaylist($id, $request)
    {
         $validateThis =  [

            'title'  => $request['title'],
            'playlist_videos' => $request['playlist_videos'],
            'remove_videos' =>$request['remove_videos']

         ];

         \Log::info($validateThis);
         $v = new PlaylistEditValidator();

         $videoAttachmentValidation  = $v->videoAttachmentValidationRule($id, $request['playlist_videos'], $request['remove_videos']);


         if($videoAttachmentValidation["validation_result"] == 'true') {
            \Log::info('going ahead with more validation');
            return $v->validate($validateThis);
         }

         return $videoAttachmentValidation;
    }


    public static function storePlaylist($request)
    {
        $validate = Playlist::validateCreatePlaylist($request);
        \Log::info($validate);
        if($validate['validation_result'] == 'false') {
           \Log::info($validate);
           return json_encode($validate);
        }


   		$playlist = Playlist::create([
   			'title' 	=> $request["title"],
   			// 'banner_id' => $request["banner_id"],
            'description' => $request["description"]
   		]);

   		PlaylistVideo::updatePlaylistVideos($playlist->id, $request);
        Playlist::updateTargetStores($request, $playlist->id);
   		return $playlist;

    }

    public static function updatePlaylist($id, $request)
    {
        $validate = Playlist::validateEditPlaylist($id, $request);

        if($validate['validation_result'] == 'false') {

           \Log::info($validate);
           return json_encode($validate);

        }
        \Log::info('validation passed: going ahead for editing');
        $playlist = Playlist::find($id);
    	$playlist['title'] = $request['title'];
        $playlist['description'] = $request['description'];
    	$playlist->save();
    	PlaylistVideo::updatePlaylistVideos($id, $request);
        Playlist::updateTargetStores($request, $id);
    	return $playlist;
    }

    // public static function updatePlaylistVideos($id, $request)
    // {
    // 	$remove_videos = $request["remove_videos"];
    //      if (isset($remove_videos)) {
    //         foreach ($remove_videos as $video) {
    //            PlaylistVideo::where('playlist_id', $id)->where('video_id', intval($video))->delete();
    //         }
    //      }

    //      $add_videos = $request["playlist_videos"];
    //      if (isset($add_videos)) {
    //         foreach ($add_videos as $video) {

    //                 $video_exists = PlaylistVideo::where('playlist_id', $id)
    //                                                 ->where('video_id', $video)
    //                                                 ->where('deleted_at', null)
    //                                                 ->first();
    //             if( ! $video_exists) {

    //                 PlaylistVideo::create([
    //                     'playlist_id'   => $id,
    //                     'video_id'      => $video
    //                 ]);
    //             }


    //         }
    //      }
    //      return;
    // }

    public static function updateTargetStores($request, $id)
    {

        $all_stores = $request['all_stores'];

        $video = Playlist::find($id);
        PlaylistTarget::where('playlist_id', $id)->delete();
        PlaylistBanner::where('playlist_id', $id)->delete();
        
        if( $all_stores == 'on' ){

            $target_banners = $request['target_banners'];
            \Log::info($target_banners);
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $key=>$banner) {
                PlaylistBanner::create([
                'playlist_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $video->all_stores = 1;
            $video->save();
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                PlaylistTarget::insert([
                    'playlist_id' => $id,
                    'store_id' => $store
                    ]);    
            }
        }  
        
        return;         
    }

    public static function getPlaylistByBanner($banner_id)
    {
        $playlists = Playlist::where('banner_id', $banner_id)
                ->where('playlists.deleted_at', '=', null)
                ->select ('playlists.*')
                ->get();

        return $playlists;
    }

    public static function getLatestPlaylists($limit=0)
    {
        if($limit == 0){
            $list = Playlist::orderBy('created_at', 'desc')->paginate(24);
        } else {
            $list = Playlist::orderBy('created_at', 'desc')->take($limit)->get();
        }

        foreach($list as $li){
            $li->count = PlaylistVideo::where('playlist_id', $li->id)->count();
            $firstVideoinList = PlaylistVideo::where('playlist_id', $li->id)->first();
            $li->thumbnail = Video::getVideoThumbnail($firstVideoinList->video_id);
            $li->sinceCreated = Utility::getTimePastSinceDate($li->created_at);
            $li->prettyDateCreated = Utility::prettifyDate($li->created_at);
        }
        return $list;
    }

    public static function getPlaylistMetaData($id)
    {
            $playlistMeta = Playlist::find($id);
            return $playlistMeta;
    }

    public static function getSelectedStoresAndBannersByPlaylistId($playlist_id)
    {
        $targetBanners = PlaylistBanner::where('playlist_id', $playlist_id)->get()->pluck('banner_id')->toArray();
        $targetStores = PlaylistTarget::where('playlist_id', $playlist_id)->get()->pluck('store_id')->toArray();

        $optGroupSelections = array_merge($targetBanners, $targetStores );
        return( $optGroupSelections );
    }
}
