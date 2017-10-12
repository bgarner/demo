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
use App\Models\Tools\CustomStoreGroup;

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
        PlaylistTarget::updateTargetStores($request, $playlist->id);
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
        PlaylistTarget::updateTargetStores($request, $id);
        $tags = $request->get('tags');
        if ($tags != null) {
            PlaylistTag::updateTags($id, $tags);
        }
    	return $playlist;
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


        $allStorePlaylists = Utility::groupBannersForAllStoreContent($allStorePlaylists);
        
        $targetedPlaylists = Playlist::join('playlist_target', 'playlist_target.playlist_id', '=', 'playlists.id')
                                ->whereIn('playlist_target.store_id', $storeList)
                                
                                ->select(\DB::raw('playlists.*, GROUP_CONCAT(DISTINCT playlist_target.store_id) as stores'))
                                ->groupBy('playlists.id')
                                ->get()
                                ->each(function($playlist){
                                    $playlist->stores = explode(',', $playlist->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $playlistsForStoreGroups = Playlist::join('playlist_store_group','playlist_store_group.playlist_id','=','playlists.id')
                                            ->whereIn('playlist_store_group.store_group_id', $storeGroups)
                                            ->select('playlists.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = PlaylistStoreGroup::where('playlist_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });
        $targetedPlaylists = Utility::mergeTargetedAndStoreGroupContent($targetedPlaylists, $playlistsForStoreGroups);

        $playlists = Utility::mergeTargetedAndAllStoreContent($targetedPlaylists, $allStorePlaylists);


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

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);

        $targetedPlaylistsForStoreGroups = Playlist::join('playlist_store_group', 'playlist_store_group.playlist_id', '=', 'playlists.id')
                                            ->whereIn('playlist_store_group.store_group_id', $storeGroups)
                                            ->select('playlists.*')
                                            ->get();

        $playlists = $targetedPlaylistsForStore->merge($allStorePlaylistsForBanners);
        $playlists = $playlists->merge($targetedPlaylistsForStoreGroups);
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

        $storeGroups = PlaylistStoreGroup::where('playlist_id', $playlist_id)->get()->pluck('store_group_id')->toArray();

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

    public static function getPlaylistById($playlistId)
    {
        $playlist = Playlist::find($playlistId);
        $playlist->tags = PlaylistTag::getTagsByPlaylistId($playlistId);

        return $playlist;
    }

}
