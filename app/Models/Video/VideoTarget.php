<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\Banner;
use App\Models\Video\Video;
use App\Models\Video\VideoBanner;
use App\Models\Video\VideoTarget;

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
}
