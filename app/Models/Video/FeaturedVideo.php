<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FeaturedVideo extends Model
{
    protected $table = 'featured_videos';
    protected $fillable = ['video_id', 'banner_id'];

    public static function getFeaturedVideoByBanner($banner_id)
    {
    	
    	$featuredVideo =  FeaturedVideo::join('videos', 'videos.id', '=', 'featured_videos.video_id')
					    				->where('banner_id', $banner_id)
					    				->select('videos.*')
					    				->first();
		$featuredVideo->likes = number_format($featuredVideo->likes);
        $featuredVideo->dislikes = number_format($featuredVideo->dislikes);
        $featuredVideo->sinceCreated = Utility::getTimePastSinceDate($featuredVideo->created_at);
        $featuredVideo->prettyDateUpdated = Utility::prettifyDate($featuredVideo->updated_at);

        return $featuredVideo;
    }
}
