<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\StoreApi\Banner;
use App\Models\Task\TaskBanner;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskStoreGroup;
use App\Events\ResouceTargetUpdated;

class TaskTarget extends Model
{
    protected $table = 'tasks_target';

    protected $fillable = ['task_id', 'store_id'];

    public static function getTargetStoresByTaskId($id)
    {
    	return TaskTarget::where('task_id', $id)->get()->pluck('store_id')->toArray();
    }

    public static function updateTargetStores($id, $request)
	{	

        $all_stores = $request['all_stores'];

        $task = Task::find($id);
        if(TaskBanner::where('task_id', $id)->exists()){
            TaskBanner::where('task_id', $id)->delete();    
        }

        if( TaskTarget::where('task_id', $id)->exists()){
            TaskTarget::where('task_id', $id)->delete(); 
        }

        if( TaskStoreGroup::where('task_id', $id)->exists()){
            TaskStoreGroup::where('task_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){
            $task->all_stores = 1;
            $task->save();
            $target_banners = $request['target_banners'];
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            
            foreach ($target_banners as $key=>$banner) {
                TaskBanner::create([
                'task_id' => $id,
                'banner_id' => $banner
                ]);
            }
        }
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                TaskTarget::insert([
                    'task_id' => $id,
                    'store_id' => $store
                    ]);    
            }
            
        }  

        if (isset($request['store_groups']) && $request['store_groups'] != '' ) {
                
            $store_groups = $request['store_groups'];
            if(! is_array($store_groups) ) {
                $store_groups = explode(',',  $request['store_groups'] );    
            }
            foreach ($store_groups as $group) {
                TaskStoreGroup::insert([
                    'task_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        } 
        Utility::addHeadOffice($id, 'tasks_target', 'task_id');

        
        event(new ResouceTargetUpdated([
            'resource_id'=> $id ,
            'asset_type_id' => 4
        ]));

        return;         

	}

	public function getTargetStores($task_id)
	{

        $task = Task::find($task_id);

        $stores = [];
        
        if(isset($task->all_stores) && $task->all_stores){
            $banners = TaskBanner::where('task_id', $task->id)->get()->pluck('banner_id')->toArray();
            
            foreach ($banners as $banner) {
                $bannerStores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();   
                $stores = array_merge($stores, $bannerStores);

            }
        }
        
        $targetStores = TaskTarget::where('task_id', $task_id)
                            ->get()
                            ->pluck('store_id')
                            ->toArray();    

        $stores = array_merge($stores, $targetStores);
        
        $storeGroups = TaskStoreGroup::join('custom_store_group', 'custom_store_group.id', '=', 'task_store_group.store_group_id')
                            ->where('task_id', $task_id)
                            ->get();

        foreach ($storeGroups as $group) {
            $groupStores = unserialize($group->stores);
            $stores = array_merge($stores, $groupStores);
        }
                                 
        return Utility::removeHeadOffice($stores);
	}


}
