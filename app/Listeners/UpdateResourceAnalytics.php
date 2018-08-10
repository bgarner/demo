<?php 

namespace App\Listeners;

use App\Events\RawAnalyticsUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Analytics\AnalyticsAssetTypes;
use App\Models\Analytics\AnalyticsCollection;

class UpdateResourceAnalytics
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RawAnalyticsUpdated  $event
     * @return void
     */
    public function handle(RawAnalyticsUpdated $event)
    {
        $analytics = $event->analytics;
        
        $assetType = AnalyticsAssetTypes::where('analytics_table_type', $analytics->type)
                        ->first();
        if(!$assetType){
            return;
        }
        
        $analyticsCollection = AnalyticsCollection::where('resource_id', $analytics->resource_id)
                                                ->where('asset_type_id', $assetType->id)
                                                ->first();
        if($analyticsCollection){
            AnalyticsCollection::updateAnalyticsCollection($analytics, $assetType);
        }
        else{
            AnalyticsCollection::createNewAnalyticsCollection($analytics, $assetType);
        }


            
    }
}
