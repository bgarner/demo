<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task\TaskTarget;

class TasklistTask extends Model
{
    protected $table = 'tasklist_tasks';

    protected $fillable = ['tasklist_id', 'task_id'];

    public static function updateTasks($tasklist_id, $request )
    {
    	
		if (isset($request["remove_tasks"])) {
			foreach ($request["remove_tasks"] as $task) {
			   TasklistTask::where('tasklist_id', $tasklist_id)->where('task_id', intval($task))->delete();
			}
		}

		if (isset($request["tasks"])) {
			foreach ($request["tasks"] as $task) {
				
				TasklistTask::create([
				  'tasklist_id' => $tasklist_id,
				  'task_id'     => $task
				]);
				
			}
		}
		
		return;
    }

    public static function getTasksByTasklistId($tasklist_id)
    {
    	return TasklistTask::join('tasks', 'tasklist_tasks.task_id', '=', 'tasks.id')
    				->where('tasklist_id', $tasklist_id)
    				->select('tasks.*')
    				->get();
    }
}
