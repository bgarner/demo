<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\Banner;
use App\Models\Video\Video;
use App\Models\Video\VideoBanner;
use App\Models\Video\VideoTarget;
use App\Models\Video\VideoStoreGroup;

class VideoTarget extends Model
{
    protected $table = 'video_target';
    protected $fillable = ['video_id', 'store_id'];

    public static function getTargetStores($video_id)
    {
    	$video = Video::find($video_id);
    	
        if(isset($video->all_stores) && $video->all_stores){
            $banners = VideoBanner::where('video_id', $video->id)->get()->pluck('banner_id')->toArray();
            $stores = [];
            foreach ($banners as $banner) {
            	$bannerStores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();	
            	$stores = array_merge($stores, $bannerStores);

            }
        }
        else{
            $stores = VideoTarget::where('video_id', $video_id)
                                            ->get()
                                            ->pluck('store_id')
                                            ->toArray();    
        }
    	return $stores;
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

        if( VideoStoreGroup::where('video_id', $id)->exists()){
            VideoStoreGroup::where('video_id', $id)->delete(); 
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

        if (isset($request['store_groups']) && $request['store_groups'] != '' ) {
                
            $store_groups = $request['store_groups'];
            if(! is_array($store_groups) ) {
                $store_groups = explode(',',  $request['store_groups'] );    
            }
            foreach ($store_groups as $group) {
                VideoStoreGroup::insert([
                    'video_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        } 
        Utility::addHeadOffice($id, 'video_target', 'video_id'); 
        return;         
    }
}
