<?php

use Illuminate\Database\Seeder;
use App\Models\Analytics\AnalyticsAssetTypes;

class AnalyticsAssetTypeSeeder extends Seeder
{
    private $asset_types = [
    	[
    		'id' => 1 ,
    	 	'analytics_table_type' => 'communication',
    	 	'target_model' => 'App\\Models\\Communication\\CommunicationTarget'
    	],
    	[
    		'id' => 2 ,
    		'analytics_table_type' => 'file',
    		'target_model' => 'App\\Models\\Document\\DocumentTarget'
    	],
    	[
    		'id' => 3 ,
    		'analytics_table_type' => 'urgentnotice',
    		'target_model' => 'App\\Models\\UrgentNotice\\UrgentNoticeTarget'
    	],
    	[
    		'id' => 4 ,
    		'analytics_table_type' => '',
    		'target_model' => 'App\\Models\\Task\\TaskTarget'
    	],
        [
        	'id' => 5 ,
        	'analytics_table_type' => 'video_watch',
        	'target_model' => 'App\\Models\\Video\\VideoTarget'
        ],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->asset_types as $type) {
        	AnalyticsAssetTypes::find($type['id'])
        		->update([
        			'analytics_table_type' => $type['analytics_table_type'],
        			'target_model'         => $type['target_model']
        		]);
        }
        
    }
}
