<?php

use Illuminate\Database\Seeder;
use App\Models\Feature\Feature;

class FeatureBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = Feature::get();

        foreach ($features as $feature) {

            \DB::table('feature_banner')->insert([
                'feature_id' => $feature->id,
                'banner_id' => $feature->banner_id
            ]);
            
        }
    }
}
