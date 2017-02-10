<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'due_date', 'publish_date', 'send_reminder', 'banner_id'];

	public static function validateCreateTask($request)
	{
		$validateThis =  [

			'title'   		=> $request['title'],
			'publish_date'  => $request['publish_date'],
			'due_date'      => $request['due_date'],
			'target_stores' => $request['target_stores'],
			'documents' 	=> $request['task_documents']

		];

		\Log::info($validateThis);
		$v = new TaskValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditTask($request)
	{
		$validateThis =  [

			'title'   		=> $request['title'],
			'publish_date'  => $request['publish_date'],
			'due_date'      => $request['due_date'],
			'target_stores' => $request['target_stores'],
			'documents' 	=> $request['task_documents'],
			'status_type_id' => $request['status_type_id'],
			'allStores' => $request['allStores'],
			'remove_document' =>$request['remove_document']

		];

		\Log::info($validateThis);
		$v = new TaskValidator();
		return $v->validate($validateThis);  
	}

	public static function createTask($request)
	{
		\Log::info($request->all());
		$validate = Task::validateCreateTask($request);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}  
		
		$task = Task::create([
			'title' 		=> $request["title"],
			'description' 	=> $request["description"],
			'publish_date'	=> $request["publish_date"],
			'due_date'		=> $request["due_date"],
			'banner_id' 	=> $request["banner_id"]
		]);

		Task::updateTargetStores($task->id, $request);
		Task::updateTaskDocuments($task->id, $request);
		return $communication;
	}

	public static function updateCommunication($id, $request)
	{
	 

		\Log::info($request->all());
		$validate = Task::validateEditTask($request);

		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		} 


		$task = Task::find($id);

		$task["title"] = $request["title"];
		$task["description"] = $request["description"];
		
		if (isset($request['communication_type_id'])) {
			$task["communication_type_id"] = $request["communication_type_id"];
		}
		
		$task["due_date"] = $request["due_date"];
		$task["publish_date"] = $request["publish_date"];

		$task->save();

		Task::updateTargetStores($task->id, $request);
		Task::updateTaskDocuments($task->id, $request);

		return $task;

	}

		



}
