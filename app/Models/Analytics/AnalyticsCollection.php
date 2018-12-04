<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Task\TasklistTask;
use App\Models\Communication\CommunicationBanner;
use App\Models\UrgentNotice\UrgentNoticeBanner;
use App\Models\Task\TaskBanner;

class AnalyticsCollection extends Model
{
    protected $table = 'analytics_collection';
    protected $fillable = ['resource_id', 'asset_type_id', 'opened_total', 'unopened_total', 'sent_to_total', 'opened', 'unopened', 'sent_to'];

    public static function getActiveCommunicationStats()
    {
    	return AnalyticsCollection::join('communications', 'communications.id', '=', 'analytics_collection.resource_id' )
    							->join('communication_types', 'communication_types.id', '=', 'communications.communication_type_id')
    							->where('asset_type_id', 1)
    							->where('communications.send_at', '>=', Carbon::now()->subDays(30))
    							->select('communications.*',
                                    'communication_types.communication_type',
                                    'communication_types.colour',
                                    'analytics_collection.opened_total',
                                    'analytics_collection.unopened_total',
                                    'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 
                                    'analytics_collection.unopened', 
                                    'analytics_collection.sent_to')
    							->get()
    							->sortByDesc('communications.send_at')
                                ->filter(function ($value, $key) {
                                    return $value->sent_to_total > 0;
                                    
                                })
    							->each(function($item){

                                    $item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
                                    if($item->readPerc > 100){
                                        $item->readPerc = 100;
                                    }
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
                                    if($item->all_stores == 1){
                                        $item->banners = CommunicationBanner::where('communication_id', $item->id)->get()->pluck('banner_id');
                                    }
                                    
    							});


    }

    public static function getActiveUrgentNoticeStats()
    {
    	return AnalyticsCollection::join('urgent_notices', 'urgent_notices.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 3)
    							->where('urgent_notices.start', '>=', Carbon::now()->subDays(30))
    							->select('urgent_notices.*', 'analytics_collection.opened_total',
                                    'analytics_collection.unopened_total',
                                    'analytics_collection.sent_to_total', 
    								'analytics_collection.opened',
                                    'analytics_collection.unopened',
                                    'analytics_collection.sent_to')
    							->get()
    							->sortByDesc('urgent_notices.start')
                                ->filter(function ($value, $key) {
                                    return $value->sent_to_total > 0;
                                    
                                })
    							->each(function($item){
                                    $item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
                                    if($item->readPerc > 100){
                                        $item->readPerc = 100;
                                    }
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
                                    if($item->all_stores == 1){
                                        $item->banners = UrgentNoticeBanner::where('urgent_notice_id', $item->id)->get()->pluck('banner_id');
                                    }
    							});


    }

    public static function getTaskStats()
    {
        $today = Carbon::now()->toDatetimeString();
    	
    	return AnalyticsCollection::join('tasks', 'tasks.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 4)
    							->select('tasks.*',
                                    'analytics_collection.opened_total',
                                    'analytics_collection.unopened_total',
                                    'analytics_collection.sent_to_total', 
    								'analytics_collection.opened',
                                    'analytics_collection.unopened',
                                    'analytics_collection.sent_to')
    							->get()
                                ->filter(function ($value, $key) {
                                    return $value->sent_to_total > 0;
                                    
                                })
    							->each(function($item){
                               
                                    $item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
                                    if($item->readPerc > 100){
                                        $item->readPerc = 100;
                                    }
    								$item->opened = json_encode(unserialize($item->opened));
                                    
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
                                    $item->banners = explode(',', $item->banners);
                                    if(TasklistTask::where('task_id', $item->id)->exists()){
                                        $item->tasklist = TasklistTask::join('tasklists', 'tasklists.id', '=', 'tasklist_tasks.tasklist_id')
                                                                    ->where('task_id', $item->id)
                                                                    ->select('tasklists.title')
                                                                    ->first()->title;
                                        
                                    }
                                    if($item->all_stores == 1){
                                        $item->banners = TaskBanner::where('task_id', $item->id)->get()->pluck('banner_id');
                                    }
    							})
                                ->filter(function ($item) use($today) {
                                    return ($item->due_date < $today && $item->readPerc < 100) || ( $item->publish_date <= $today && $item->due_date >= $today) ;
                                })->values();
    	
    }

    public static function getVideoStats()
    {
    	
    	return AnalyticsCollection::join('videos', 'videos.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 5)
    							->select('videos.*', 'analytics_collection.opened_total', 'analytics_collection.unopened_total', 'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 'analytics_collection.unopened', 'analytics_collection.sent_to'
    							 )
    							->get()
                                ->filter(function ($value, $key) {
                                    return $value->sent_to_total > 0;
                                    
                                })
    							->each(function($item){
                                
                                    $item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
                                    if($item->readPerc > 100){
                                        $item->readPerc = 100;
                                    }
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
    							});
    	
    }

    public static function getPaginatedVideoStats($request)
    {
        $allVideoStats = AnalyticsCollection::getVideoStats();        
        if(count($allVideoStats) < 1){
            return;
        }

        $videoStatsSlices = array_chunk( $allVideoStats->toArray(), 15);
        
        $videoStats = $videoStatsSlices[0];
        $videoNextPageIndex = 2;
        $videoPreviousPageIndex = '';
        
        if(isset($request->page) && ($request->page!='') && is_numeric($request->page)){

            $page = intval($request->page);
            if($page > count($videoStatsSlices)){
                $videoStats = $videoStatsSlices[count($videoStatsSlices) -1];
            }
            elseif($page < 1){
                $videoStats = $videoStatsSlices[0];   
            }
            else{
                $videoStats = $videoStatsSlices[$page -1];    
            }
            $videoNextPageIndex = $page+1;
            $videoPreviousPageIndex = $page-1;
            
        }

        $paginatedVideos = [];
        $paginatedVideos['videoStats'] = $videoStats;
        $paginatedVideos['nextPage'] = $videoNextPageIndex;
        $paginatedVideos['previousPage'] = $videoPreviousPageIndex;
        
        return $paginatedVideos;
    }

    public static function getAnalyticsByResource($resource_type_id, $resource_id)
    {
        $analytics =  Self::where('asset_type_id', $resource_type_id)
                        ->where('resource_id', $resource_id)
                        ->first();
        if($analytics){
            return unserialize($analytics->opened);
        }

        return[];
    }

    public static function createNewAnalyticsCollection($analytics, $assetType)
    {
        $targetModel = new $assetType->target_model();
        $opened = [$analytics->store_number];
        $sent_to = $targetModel->getTargetStores($analytics->resource_id);
        $unopened = array_diff($sent_to, $opened);

        AnalyticsCollection::create([
            'resource_id'    => $analytics->resource_id,
            'asset_type_id'  => $assetType->id,
            'opened_total'   => count($opened),
            'unopened_total' => count($unopened),
            'sent_to_total'  => count($sent_to),
            'opened'         => serialize($opened),
            'unopened'       => serialize($unopened),
            'sent_to'        => serialize($sent_to),
        ]);

    }

    public static function updateAnalyticsCollection($analytics, $assetType)
    {
        $analyticsCollection = AnalyticsCollection::where('asset_type_id', $assetType->id)
                                    ->where('resource_id', $analytics->resource_id)
                                    ->first();
        
        $opened = unserialize($analyticsCollection->opened);

        if(array_search($analytics->store_number, $opened) === false){
            array_push($opened, $analytics->store_number);
            $unopened = array_diff(
                            unserialize($analyticsCollection->unopened), 
                            [$analytics->store_number]
                        );

            $opened = array_values(array_unique($opened));
            $unopened = array_values(array_unique($unopened));

            $analyticsCollection->update([
                'opened_total'   => count($opened),
                'unopened_total' => count($unopened),
                'opened'         => serialize($opened),
                'unopened'       => serialize($unopened)

            ]);
        }
        
    }

    public static function createNewTaskAnalyticsCollection($analytics, $assetType)
    {   
        $targetModel = new $assetType->target_model();
        $opened = [$analytics->store_id];
        $sent_to = $targetModel->getTargetStores($analytics->task_id);
        $unopened = array_diff($sent_to, $opened);

        AnalyticsCollection::create([
            'resource_id'    => $analytics->task_id,
            'asset_type_id'  => $assetType->id,
            'opened_total'   => count($opened),
            'unopened_total' => count($unopened),
            'sent_to_total'  => count($sent_to),
            'opened'         => serialize($opened),
            'unopened'       => serialize($unopened),
            'sent_to'        => serialize($sent_to),
        ]);
    }

    public static function updateTaskAnalyticsCollection($analytics, $assetType)
    {
        
        $analyticsCollection = AnalyticsCollection::where('asset_type_id', $assetType->id)
                                        ->where('resource_id', $analytics->task_id)
                                        ->first();
            
        $opened = unserialize($analyticsCollection->opened);
        $unopened = unserialize($analyticsCollection->unopened);

        if($analytics->status_type_id == 2){ //done
                
            array_push($opened, $analytics->store_id);
            $unopened = array_diff(
                            unserialize($analyticsCollection->unopened), 
                            [$analytics->store_id]
                        );
            


        }
        else if($analytics->status_type_id == 1){ // not done
            array_push($unopened, $analytics->store_id);
            $opened = array_diff(
                            unserialize($analyticsCollection->opened), 
                            [$analytics->store_id]
                        );
            
        }

        $opened = array_values(array_unique($opened));
        $unopened = array_values(array_unique($unopened));


        $analyticsCollection->update([
                    'opened_total'   => count($opened),
                    'unopened_total' => count($unopened),
                    'opened'         => serialize($opened),
                    'unopened'       => serialize($unopened)

                ]);

    }

    public static function updateResourceTarget($resource, $assetType)
    {
        
        $targetModel = new $assetType->target_model();
        $sent_to = $targetModel->getTargetStores($resource['resource_id']);

        $analyticsCollection = AnalyticsCollection::where('resource_id', $resource['resource_id'])
            ->where('asset_type_id', $assetType->id)
            ->first();

        $opened = unserialize($analyticsCollection->opened);
        $unopened = array_diff($sent_to, $opened);
        $analyticsCollection->update([
                'sent_to_total'  => count($sent_to),
                'sent_to'        => serialize($sent_to),
                'unopened_total' => count($unopened),
                'unopened'       => serialize($unopened),

            ]);

    }
}