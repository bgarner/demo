<?php

use Illuminate\Database\Seeder;
use App\Models\StoreApi\Banner;

class BannerTableBannerClassSeeder extends Seeder
{
    private $bannerClasses = [
    	['banner_id'=>1, 'banner_class' => 'sc'],
    	['banner_id'=>2, 'banner_class' => 'atmo']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->bannerClasses as $class){
        	
        	$banner = Banner::find($class['banner_id']);
        	$banner->banner_class = $class['banner_class'];
        	$banner->save();
        }
    }
}
