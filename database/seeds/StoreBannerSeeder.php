<?php

use Illuminate\Database\Seeder;
use App\Models\StoreApi\Store;

class StoreBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$storeBanners = DB::table('banner_store')->get();

        foreach ($storeBanners as $sb) {
            Store::find($sb->store_id)->update(['banner_id' => $sb->banner_id]);
        }
    }
}
