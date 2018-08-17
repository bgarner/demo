<?php

namespace App\Listeners;

use App\Events\ResouceTargetUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Analytics\AnalyticsAssetTypes;
use App\Models\Analytics\AnalyticsCollection;

class UpdateResourceTargetAnalytics implements ShouldQueue
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
     * @param  ResouceTargetUpdated  $event
     * @return void
     */
    public function handle(ResouceTargetUpdated $event)
    {
        $resource = $event->resource;

        $assetType = AnalyticsAssetTypes::find($resource['asset_type_id']);

        $analyticsCollection = AnalyticsCollection::where('resource_id', $resource['resource_id'])
                                                ->where('asset_type_id', $resource['asset_type_id'])
                                                ->first();

        if($analyticsCollection){
            AnalyticsCollection::updateResourceTarget($resource, $assetType);
        }

        return;
    }
}
