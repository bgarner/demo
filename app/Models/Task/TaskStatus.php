<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = 'task_status';

    protected $fillable = ['task_id', 'status_type_id'];

    public static function updateTaskStatusType($id, $request)
    {
    	if(isset($request->status_type_id)){
            
            TaskStatus::where('task_id', $id)->first()->delete();

        	TaskStatus::create([
        		'task_id' => $id,
        		'status_type_id' => $request['status_type_id']
        	]);	
        }

    	
    }
}
