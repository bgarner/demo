<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use App\Models\Analytics\Analytics;
use App\Models\Analytics\AnalyticsAssetTypes;
use App\Models\Analytics\AnalyticsCollection;
use App\Models\Communication\CommunicationTarget;
use App\Models\Document\DocumentTarget;
use App\Models\UrgentNotice\UrgentNoticeTarget;

class AnalyticsTask extends Model
{
    public static function compileCommunicationAnalytics()
    {
		$compiledAnalytics = \DB::select( 
								\DB::raw( "Select GROUP_CONCAT(DISTINCT `type`) as asset_type, 
                                        `resource_id`, 
										COUNT(DISTINCT `store_number`) as opened_total,
										GROUP_CONCAT( DISTINCT `store_number` ) as opened_by
										from `analytics`
										where `type` = 'communication'  
										group by `resource_id`, `type`") 
								);
		$asset_type_id  = AnalyticsAssetTypes::where('type', 'communication')->first()->id;

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'CommunicationTarget');
    	
    	return $compiledAnalytics;

    }

    public static function compileAlertAnalytics()
    {
		$compiledAnalytics = \DB::select( 
								\DB::raw( "Select GROUP_CONCAT(DISTINCT `type`) as asset_type,
                                        `resource_id`, 
										COUNT(DISTINCT `store_number`) as opened_total,
										GROUP_CONCAT( DISTINCT `store_number` ) as opened_by
										from `analytics`
										where `type` = 'file' and `location` = 'alerts'  
										group by `resource_id`, `type`") 
								);
		$asset_type_id  = AnalyticsAssetTypes::where('type', 'alert')->first()->id;

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'DocumentTarget');

    	return $compiledAnalytics;

    }

    public static function compileUrgentNoticeAnalytics()
    {
		$compiledAnalytics = \DB::select( 
								\DB::raw( "Select GROUP_CONCAT(DISTINCT `type`) as asset_type,
                                        `resource_id`, 
										COUNT(DISTINCT `store_number`) as opened_total,
										GROUP_CONCAT( DISTINCT `store_number` ) as opened_by
										from `analytics`
										where `type` = 'urgentnotice'  
										group by `resource_id`, `type`") 
								);
		$asset_type_id  = AnalyticsAssetTypes::where('type', 'urgentnotice')->first()->id;

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'UrgentNoticeTarget');

    	return $compiledAnalytics;

    }



    public static function compileAnalytics()
    {
    	AnalyticsCollection::truncate();

    	$compiledCommunicationAnalytics = Self::compileCommunicationAnalytics();
    	Self::storeAnalyticsCollection($compiledCommunicationAnalytics);

    	$compiledAlertAnalytics = Self::compileAlertAnalytics();
    	Self::storeAnalyticsCollection($compiledAlertAnalytics);

    	$compiledUrgentNoticeAnalytics = Self::compileUrgentNoticeAnalytics();
    	Self::storeAnalyticsCollection($compiledUrgentNoticeAnalytics);

    	return;
    }

    public static function storeAnalyticsCollection($compiledAnalytics)
    {
    	
    	foreach ($compiledAnalytics as $ca) {
    		AnalyticsCollection::create([
    			'resource_id'    => $ca->resource_id,
    			'asset_type_id'  => $ca->asset_type_id,
    			'opened_total'   => $ca->opened_total,
    			'unopened_total' => $ca->not_opened_by_total,
    			'sent_to_total'  => $ca->sent_to_total,
    			'opened'         => serialize($ca->opened_by),
    			'unopened'       => serialize($ca->not_open_by),
    			'sent_to'        => serialize($ca->sent_to)

    		]);
    	}

    	return;	
    }



    private static function processAnalytics($compiledAnalytics, $asset_type_id, $target_table)
    {
        foreach ($compiledAnalytics as $ca) {
            $openedByStore = explode(",", $ca->opened_by);
            $ca->opened_by = $openedByStore;
            $notOpenedByStore = [];

            $model = new $target_table();
            $sent_to = $model->getTargetStores($ca->resource_id);
            foreach ($sent_to as $store) {
                if(!in_array($store, $openedByStore)){
                    array_push($notOpenedByStore, $store);
                }
            }
            $ca->sent_to = $sent_to;
            $ca->sent_to_total = count($sent_to);
            $ca->not_open_by = $notOpenedByStore;
            $ca->not_opened_by_total = count($notOpenedByStore);
            $ca->asset_type_id = $asset_type_id;


        }
        return $compiledAnalytics;

    }

}
/*
$a = new App\Models\Analytics\AnalyticsTask;
$a->compileAnalytics();
*/