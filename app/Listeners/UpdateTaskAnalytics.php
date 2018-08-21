<?php

namespace App\Listeners;

use App\Events\TaskStoreStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Analytics\AnalyticsAssetTypes;
use App\Models\Analytics\AnalyticsCollection;

class UpdateTaskAnalytics implements ShouldQueue
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
     * @param  TaskStoreStatusUpdated  $event
     * @return void
     */
    public function handle($event)
    {
        
        $analytics = $event->analytics;
        
        $assetType = AnalyticsAssetTypes::find(4); //asset_type_id for task

        $analyticsCollection = AnalyticsCollection::where('resource_id', $analytics->task_id)
                                                ->where('asset_type_id', $assetType->id)
                                                ->first();

        if($analyticsCollection){
            AnalyticsCollection::updateTaskAnalyticsCollection($analytics, $assetType);
        }
        else{
            AnalyticsCollection::createNewTaskAnalyticsCollection($analytics, $assetType);
        }
    }
}
