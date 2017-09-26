<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\StoreApi\Banner;

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
		$target_stores = $request['target_stores'];
		$allStores = $request['all_stores'];

		if($allStores == 'on') {
            TaskTarget::where('task_id', $id)->delete();
            $task = Task::find($id);
            $task->all_stores = 1;
            $task->save();
        }
        else{
        	TaskTarget::where('task_id', $id)->delete();
			if (count($target_stores) > 0) {
				foreach ($target_stores as $store) {
					TaskTarget::create([
						'task_id'   => $id,
						'store_id'  => $store
					]);

				} 
			}
			if(!in_array('0940', $target_stores)){
				Utility::addHeadOffice($id, 'tasks_target', 'task_id');
			}
			$task = Task::find($id);
        	$task->all_stores = 0;
        	$task->save();            
			
		}

		return;

	}

	public function getTargetStores($task_id)
	{
		$task = Task::find($task_id);

        if(isset($task->all_stores) && $task->all_stores){
            $banner = $task->banner_id;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();
        }
        else{
            $stores = TaskTarget::where('task_id', $task_id)
                                ->get()
                                ->pluck('store_id')
                                ->toArray();    
        }


        return $stores;
	}
}
