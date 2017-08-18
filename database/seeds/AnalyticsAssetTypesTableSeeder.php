<?php

use Illuminate\Database\Seeder;
use App\Models\Analytics\AnalyticsAssetTypes;

class AnalyticsAssetTypesTableSeeder extends Seeder
{
    private $asset_types = [
    	['id' => 1 , 'type' => 'communication'],
    	['id' => 2 , 'type' => 'alert'],
    	['id' => 3 , 'type' => 'urgentnotice'],
    	['id' => 4 , 'type' => 'task'],
        ['id' => 5 , 'type' => 'video'],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnalyticsAssetTypes::truncate();
        foreach ($this->asset_types as $type) {
        	AnalyticsAssetTypes::create($type);
        }
        
    }
}
