<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\TasklistValidator;
use App\Models\Utility\Utility;
use Carbon\Carbon;

class Tasklist extends Model
{
    protected $table = 'tasklists';

    protected $fillable = ['title', 'description', 'due_date', 'publish_date'];

    public static function validateCreateTasklist($request)
	{
		$validateThis =  [

			'title'   		=> $request['title'],
			'target_stores' => $request['target_stores']

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }

		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		\Log::info($validateThis);
		$v = new TasklistValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditTasklist($request)
	{
		$validateThis =  [

			'title'   		 => $request['title'],
			'target_stores'  => $request['target_stores']

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }

		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		if(isset($request['remove_tasks'])){
			$validateThis['remove_tasks'] = $request['remove_tasks'];
		}

		\Log::info($validateThis);
		$v = new TasklistValidator();
		return $v->validate($validateThis);  
	}


    public static function getTasklists()
    {
    	return Tasklist::all()
    					->each(function($list){
    						$list->prettyDueDate = Utility::prettifyDate($list->due_date);
    					});
    }
    public static function createTaskList($request)
    {

		$validate = Tasklist::validateCreateTasklist($request);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}  

		$description = '';
		if(isset($request['description'])) {
			$description = $request['description'];
		}

		$publish_date = Carbon::now();
		if(isset($request['publish_date'])) {
			$publish_date = $request['publish_date'];
		}

		$tasklist = Tasklist::create([
				'title' 		=> $request['title'],
				'description' 	=> $request["description"],
				'publish_date'	=> $request["publish_date"],
				'due_date'		=> $request["due_date"]
			]);
		TasklistTarget::updateTargetStores($tasklist->id, $request);

		foreach ($request->tasks as $task) {

			$request['title'] = $task;
			$request['send_reminder'] = NULL;
			$task = Task::createTask($request);

			TasklistTask::create([
				'tasklist_id' => $tasklist->id,
				'task_id'	=> $task->id
			]);
		}
		
		return $tasklist;
    }

    public static function updateTasklist($request, $id)
    {
    	\Log::info($request->all());
		$validate = Tasklist::validateEditTasklist($request);

		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		} 


		$tasklist = Tasklist::find($id);

		$tasklist["title"] = $request["title"];
		$tasklist["due_date"] = $request["due_date"];
		if(isset($request['description'])) {
			$tasklist["description"] = $request['description'];
		}

		if(isset($request['publish_date'])) {
			$tasklist["publish_date"] = $request['publish_date'];
		}

		$tasklist->save();

		TasklistTarget::updateTargetStores($tasklist->id, $request);
		TasklistTask::updateTasks($tasklist->id, $request);

		return $tasklist;
    }

    public static function getTasklistById($id)
    {
    	$tasklist = Tasklist::find($id); 
    	$tasklist->tasks = TasklistTask::join('tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
    								->where('tasklist_id', $id)
    								->select('tasks.*')
    								->get();

    	return $tasklist;
    }
}
