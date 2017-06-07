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

    public static function getFeaturedBannerByVideoId($id)
    {
        return Video::join('featured_videos', 'featured_videos.video_id', '=', 'videos.id')
                    ->where('featured_videos.video_id', $id)
                    ->select('featured_videos.banner_id')
                    ->get();
    }

    public static function updateFeaturedOn($video_id, $request)
    {
        if(isset($request->featured) && $request->featured){
            if(isset($request->featuredOn)){
                $featuredOn = $request->featuredOn;
                foreach ($featuredOn as $banner_id) {
                    $previousFeaturedVideo = FeaturedVideo::where('banner_id', $banner_id)->first();
                    if($previousFeaturedVideo){
                        $previousFeaturedVideo->delete();
                    }
                    FeaturedVideo::create([
                        'video_id' => $video_id,
                        'banner_id' => $banner_id
                        ]);
                }
            }
        }
        else{
            $isVideoFeatured = FeaturedVideo::isVideoFeatured($video_id);
            if($isVideoFeatured){
                FeaturedVideo::where('video_id',$video_id)->delete();
            }
        }



        return;
    }

    public static function isVideoFeatured($video_id)
    {
        $count = FeaturedVideo::where('video_id',$video_id)->get()->count();
        if($count>0){
            return true;
        }
        return false;
    }
    public static function removeFeaturedVideoFlag($video_id, $banner_id)
    {
        $featuredVideo = FeaturedVideo::where('video_id', 1)->first();
        if( $featuredVideo !== null )
        {
            $featuredVideo->featured = 0;
            $featuredVideo->save();
        }

        return;
    }

}
