<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;
use App\Models\Validation\PlaylistValidator;
use App\Models\Validation\PlaylistEditValidator;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\StoreInfo;
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
            'title'  => $request['title']
        ];

        if(isset($request['playlist_videos']) && !empty($request['playlist_videos']))
        {
            $validateThis['playlist_videos'] = $request['playlist_videos'];
        }
        
        if(isset($request['remove_videos']) && !empty($request['remove_videos']))
        {
            $validateThis['remove_videos'] = $request['remove_videos'];
        }

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

        $playlist = Playlist::find($id);
    	$playlist->title = $request['title'];
        $playlist->description = $request['description'];
    	$playlist->save();
    	PlaylistVideo::updatePlaylistVideos($id, $request);
        Playlist::updateTargetStores($request, $id);
        $tags = $request->get('tags');
        if ($tags != null) {
            PlaylistTag::updateTags($id, $tags);
        }
    	return $playlist;
    }

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
            // if(!in_array('0940', $target_stores)){
            // Utility::addHeadOffice($id, 'playlist_target', 'playlist_id');
            // }
        }  
        
        return;         
    }

    public static function getPlaylistsForAdmin()
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

        $allStorePlaylists = Playlist::join('playlist_banner', 'playlist_banner.playlist_id', '=', 'playlists.id')
                                ->where('all_stores', 1)
                                ->whereIn('playlist_banner.banner_id', $banners)
                                ->select('playlists.*', 'playlist_banner.banner_id')
                                ->get();


        $allStorePlaylists = Playlist::groupBannersForAllStorePlaylists($allStorePlaylists);
        
        $targetedPlaylists = Playlist::join('playlist_target', 'playlist_target.playlist_id', '=', 'playlists.id')
                                ->whereIn('playlist_target.store_id', $storeList)
                                ->select('playlists.*', 'playlist_target.store_id')
                                ->get();

        $targetedPlaylists = Playlist::groupStoresForTargetedPlaylists($targetedPlaylists);

        $playlists = Playlist::mergeTargetedAndAllStoreAssets($targetedPlaylists, $allStorePlaylists);


        foreach ($playlists as $playlist) {
            
            $playlist->prettyDateCreated = Utility::prettifyDate($playlist->created_at);
            $playlist->prettyDateUpdated = Utility::prettifyDate($playlist->updated_at);
        }
                        
                        
        return $playlists;
    }

    public static function getPlaylistByBanner($banner_id)
    {
        $playlists = Playlist::where('banner_id', $banner_id)
                ->where('playlists.deleted_at', '=', null)
                ->select ('playlists.*')
                ->get();

        return $playlists;
    }

    public static function getLatestPlaylists($store_id, $limit=0)
    {
        if($limit == 0){
            
            $list = Playlist::getPlaylistForStore($store_id)->sortByDesc('created_at');
            $list = Video::paginate($list, 24)->setPath('playlists');

        } else {
            $list = Playlist::getPlaylistForStore($store_id)->sortByDesc('created_at')->take($limit);
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

    public static function getPlaylistForStore($store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        $allStorePlaylistsForBanners = Playlist::join('playlist_banner', 'playlists.id', '=', 'playlist_banner.playlist_id' )          
                                            ->where('playlists.all_stores', 1)
                                            ->where('playlist_banner.banner_id', $banner_id)
                                            ->select('playlists.*')
                                            ->get();

        $targetedPlaylistsForStore = Playlist::join('playlist_target', 'playlist_target.playlist_id', '=', 'playlists.id')
                                        ->where('playlist_target.store_id', $store_id)
                                        ->select('playlists.*')
                                        ->get();
        $playlists = $targetedPlaylistsForStore->merge($allStorePlaylistsForBanners);
        
        return $playlists;
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

    public static function groupBannersForAllStorePlaylists($allStorePlaylists)
    {
        $allStorePlaylists = $allStorePlaylists->toArray();
        $compiledPlaylists = [];
        foreach ($allStorePlaylists as $playlist) {
            $index = array_search($playlist['id'], array_column($compiledPlaylists, 'id'));
            if(  $index !== false ){
               array_push($compiledPlaylists[$index]->banners, $playlist["banner_id"]);
            }
            else{
               
               $playlist["banners"] = [];
               array_push( $playlist["banners"] , $playlist["banner_id"]);
               array_push( $compiledPlaylists , (object) $playlist);
            }

        }
        
        return collect($compiledPlaylists);
    }

    public static function groupStoresForTargetedPlaylists($targetedPlaylists)
    {
        $targetedPlaylists = $targetedPlaylists->toArray();
        $compiledPlaylists = [];
        foreach ($targetedPlaylists as $playlist) {
            $index = array_search($playlist['id'], array_column($compiledPlaylists, 'id'));
            if(  $index !== false ){
               array_push($compiledPlaylists[$index]->stores, $playlist["store_id"]);
            }
            else{
               
               $playlist["stores"] = [];
               array_push( $playlist["stores"] , $playlist["store_id"]);
               array_push( $compiledPlaylists , (object) $playlist);
            }

        }
        
        return collect($compiledPlaylists);
    }

    public static function mergeTargetedAndAllStoreAssets($targetedPlaylists, $allStorePlaylists)
    {

        foreach($targetedPlaylists as $targetedPlaylist)
        {
            $id = $targetedPlaylist->id;

            if($allStorePlaylists->contains('id', $id)){
                
                $playlistIndex = $allStorePlaylists->where('id', $id)->keys()->toArray()[0];
                $allStorePlaylists[$playlistIndex]->stores = $targetedPlaylist->stores;
                
            }
            else{
                $allStorePlaylists->merge($targetedPlaylist);
            }
        }

        $playlists = $allStorePlaylists->merge($targetedPlaylists)->unique('id')->sortByDesc('created_at');

        return $playlists;
    }

    public static function getPlaylistById($playlistId)
    {
        $playlist = Playlist::find($playlistId);
        $playlist->tags = PlaylistTag::getTagsByPlaylistId($playlistId);

        return $playlist;
    }

}
