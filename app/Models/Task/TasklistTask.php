<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TasklistTask extends Model
{
    protected $table = 'tasklist_tasks';

    protected $fillable = ['tasklist_id', 'task_id'];

    public static function updateTasks($tasklist_id, $request )
    {
    	$remove_tasks = $request["remove_tasks"];
		if (isset($remove_tasks)) {
			foreach ($remove_tasks as $task) {
			   TasklistTask::where('tasklist_id', $tasklist_id)->where('task_id', intval($task))->delete();
			   Task::find($task)->delete();
			}
		}

		$add_tasks = $request["tasks"];
		if (isset($add_tasks)) {
			foreach ($add_tasks as $task) {
				$request['title'] = $task;
				$request['send_reminder'] = NULL;
				$task = Task::createTask($request);
				TasklistTask::create([
				  'tasklist_id' => $tasklist_id,
				  'task_id'     => $task->id
				]);
			}
		}
		return;
    }
}
