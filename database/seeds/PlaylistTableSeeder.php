<?php

use Illuminate\Database\Seeder;
use App\Models\Video\Playlist;
use App\Models\Video\PlaylistBanner;
use App\Models\StoreApi\Banner;

class PlaylistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlists = Playlist::all();
        $banners = Banner::all()->pluck('id')->toArray();
        foreach ($playlists as $playlist) {
        	Playlist::find($playlist->id)->update(['all_stores'=> 1]);
        	foreach ($banners as $banner) {
        		PlaylistBanner::create([
        			'playlist_id' => $playlist->id,
        			'banner_id' => $banner
        		]);
        	}
        }
    }
}
