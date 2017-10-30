<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use App\Models\Video\Playlist;
use App\Models\Video\PlaylistBanner;
use App\Models\Video\PlaylistTarget;
use App\Models\Video\PlaylistStoreGroup;
use App\Models\Utility\Utility;

class PlaylistTarget extends Model
{
    protected $table = 'playlist_target';

    protected $fillable = ['playlist_id', 'store_id'];

    public static function updateTargetStores($request, $id)
    {

        $all_stores = $request['all_stores'];

        $playlist = Playlist::find($id);
        if(PlaylistBanner::where('playlist_id', $id)->exists()){
            PlaylistBanner::where('playlist_id', $id)->delete();    
        }

        if( PlaylistTarget::where('playlist_id', $id)->exists()){
            PlaylistTarget::where('playlist_id', $id)->delete(); 
        }

        if( PlaylistStoreGroup::where('playlist_id', $id)->exists()){
            PlaylistStoreGroup::where('playlist_id', $id)->delete(); 
        }
        
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
            
            $playlist->all_stores = 1;
            $playlist->save();
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
        if (isset($request['store_groups']) && $request['store_groups'] != '' ) {
                
            $store_groups = $request['store_groups'];
            if(! is_array($store_groups) ) {
                $store_groups = explode(',',  $request['store_groups'] );    
            }
            foreach ($store_groups as $group) {
                PlaylistStoreGroup::insert([
                    'playlist_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        }  
        Utility::addHeadOffice($id, 'playlist_target', 'playlist_id');
        return;         
    }
}
