<?php

namespace App\Listeners;

use App\Events\TaskStoreStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTaskAnalytics
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
    public function handle(TaskStoreStatusUpdated $event)
    {
        $store_status = $event->taskStoreStatus;
        $analyticsCollection = AnalyticsCollection::where('resource_id', $store_status->task_id)
                                                ->where('asset_type_id', $store_status->asset_type_id)
                                                ->first();
        if($analyticsCollection){
            AnalyticsCollection::updateTaskAnalyticsCollection($store_status);
        }
        else{
            AnalyticsCollection::createNewTaskAnalyticsCollection($store_status);
        }
    }
}
