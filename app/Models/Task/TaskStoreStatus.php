<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskStoreStatus extends Model
{
    protected $table = 'task_store_status';

    protected $fillable = ['task_id', 'store_id', 'status_type_id'];

    public static function updateTaskStatusType($id, $request)
    {
    	if(isset($request->status_type_id)){
            
            TaskStoreStatus::where('task_id', $id)->first()->delete();

        	TaskStoreStatus::create([
        		'task_id' => $id,
                'store_id' => $request['store_id'],
        		'status_type_id' => $request['status_type_id']
        	]);	
        }

    	
    }

    public static function getStoresDone($task_id)
    {
        $storesDone = TaskStoreStatus::join('task_store_status_types', 'task_store_status_types.id' , '=', 'task_store_status.status_type_id')
                       ->where('task_id', $task_id)
                       ->where('task_store_status_types.status_title', 'done')
                       ->get()->pluck('store_id')->toArray();
        return $storesDone;

    }

}
