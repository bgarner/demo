<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use App\Models\Analytics\Analytics;
use App\Models\Analytics\AnalyticsAssetTypes;
use App\Models\Analytics\AnalyticsCollection;
use App\Models\Communication\CommunicationTarget;
use App\Models\Document\DocumentTarget;
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Task\Task;
use App\Models\Task\TaskStoreStatus;
use App\Models\Task\TaskTarget;
use Carbon\Carbon;
use App\Models\Video\Video;

class AnalyticsTask extends Model
{
    
     public static function compileAnalytics()
    {
        AnalyticsCollection::truncate();

        $compiledCommunicationAnalytics = Self::compileCommunicationAnalytics();
        Self::storeAnalyticsCollection($compiledCommunicationAnalytics);

        $compiledAlertAnalytics = Self::compileAlertAnalytics();
        Self::storeAnalyticsCollection($compiledAlertAnalytics);

        $compiledUrgentNoticeAnalytics = Self::compileUrgentNoticeAnalytics();
        Self::storeAnalyticsCollection($compiledUrgentNoticeAnalytics);

        $compiledTaskAnalytics = Self::compileTaskAnalytics();
        Self::storeAnalyticsCollection($compiledTaskAnalytics);

        $compiledVideoAnalytics = Self::compileVideoAnalytics();
        Self::storeAnalyticsCollection($compiledVideoAnalytics);

        return;
    }

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

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'CommunicationTarget', 'Communication');
    	
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

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'DocumentTarget', 'Alert');

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

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'UrgentNoticeTarget', 'UrgentNotice');

    	return $compiledAnalytics;

    }

    public static function compileTaskAnalytics()
    {
        $today = Carbon::now();
        $tasks = Task::all();
        $asset_type_id  = AnalyticsAssetTypes::where('type', 'task')->first()->id;

        foreach ($tasks as $key=>$task) {

            $completedByStores = TaskStoreStatus::where('task_id', $task->id)
                                                ->where('status_type_id', '2')
                                                ->get()->pluck('store_id')->toArray();
            if(count($completedByStores) <= 0) {
                $completedByStores = [];
            }
            $model = new TaskTarget();
            $sent_to = $model->getTargetStores($task->id);
            $notCompletedByStores = [];

            if(count($sent_to) == count($completedByStores) && $task->due_date < $today ){
                $tasks->forget($key);
                continue;
            }
            foreach ($sent_to as $store) {
                if(!in_array($store, $completedByStores)){
                    array_push($notCompletedByStores, $store);
                }
            }

            $task->resource_id = $task->id;
            $task->opened_by = $completedByStores;
            $task->opened_total = count($completedByStores);
            $task->sent_to = $sent_to;
            $task->sent_to_total = count($sent_to);
            $task->not_opened_by = $notCompletedByStores;
            $task->not_opened_by_total = count($notCompletedByStores);
            $task->asset_type_id = $asset_type_id;
        }

        return $tasks;


    }

    public static function compileVideoAnalytics()
    {
        $compiledAnalytics = \DB::select( 
                                \DB::raw( "Select GROUP_CONCAT(DISTINCT `type`) as asset_type,
                                        `resource_id`, 
                                        COUNT(DISTINCT `store_number`) as opened_total,
                                        GROUP_CONCAT( DISTINCT `store_number` ) as opened_by
                                        from `analytics`
                                        where `type` = 'video'  
                                        group by `resource_id`, `type`") 
                                );
        $asset_type_id  = AnalyticsAssetTypes::where('type', 'video')->first()->id;

        $compiledAnalytics = Self::processAnalytics($compiledAnalytics, $asset_type_id, 'VideoTarget', 'Video');

        return $compiledAnalytics;
    }

    
    private static function processAnalytics($compiledAnalytics, $asset_type_id, $target_table, $resource_model)
    {
        $resourceModel = new $resource_model();
        foreach ($compiledAnalytics as $key=>$ca) {

            if( $resourceModel->find($ca->resource_id)){
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
                $ca->not_opened_by = $notOpenedByStore;
                $ca->not_opened_by_total = count($notOpenedByStore);
                $ca->asset_type_id = $asset_type_id;    
            }
            else{
                    unset($compiledAnalytics[$key]);
            }
            


        }
        return $compiledAnalytics;

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
                'unopened'       => serialize($ca->not_opened_by),
                'sent_to'        => serialize($ca->sent_to)

            ]);
        }

        return; 
    }

    public static function getVideoReportInTimespan($request)
    {
        $start = $request->start;
        $end = $request->end;    

        return Analytics::where('type', '=', 'video')
                        ->where('created_at', '>', $start)
                        ->where('created_at', "<", $end)
                        ->select('store_number' , \DB::raw('count(*) as total_views'))
                        ->groupBy('store_number')
                        ->get();

    }


}
/*
$a = new App\Models\Analytics\AnalyticsTask;
$a->compileAnalytics();
*/