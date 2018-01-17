<?php

use Illuminate\Database\Seeder;
use App\Models\Video\Video;
use App\Models\Video\VideoBanner;
use App\Models\StoreApi\Banner;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = Video::all();
        $banners = Banner::all()->pluck('id')->toArray();
        foreach ($videos as $video) {
        	Video::find($video->id)->update(['all_stores'=> 1]);
        	foreach ($banners as $banner) {
        		VideoBanner::create([
        			'video_id' => $video->id,
        			'banner_id' => $banner
        		]);
        	}
        	
        		
        }
    }
}
