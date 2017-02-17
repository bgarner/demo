<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\TaskValidator;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskDocument;
use App\Models\Task\TaskStatus;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\UserResource;
use App\Models\StoreInfo;

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
			'banner_id' 	=> $request["banner_id"],
			'send_reminder'	=> (bool) $request["send_reminder"]
		]);

		TaskTarget::updateTargetStores($task->id, $request);
		TaskDocument::updateTaskDocuments($task->id, $request);
		TaskCreator::updateTaskCreator($task->id, \Auth::user()->id);
		return $task;
	}

	public static function updateTask($id, $request)
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
		$task["due_date"] = $request["due_date"];
		$task["publish_date"] = $request["publish_date"];
		$task["send_reminder"]	= (bool) $request["send_reminder"];

		$task->save();

		TaskTarget::updateTargetStores($task->id, $request);
		TaskDocument::updateTaskDocuments($task->id, $request);
		TaskStatus::updateTaskStatusType($task->id, $request);

		return $task;

	}

	public static function deleteTask($id)
	{
		Task::find($id)->delete();
	}
	
	public static function getActiveTasksByUserId($user_id)
	{
		$role = Role::getRoleByUserId($user_id);

		switch ($role) {
			case 'dm':
				$tasks = Task::getActiveTasksByDistrictManagerId($user_id);
				break;
			case 'avp':
				$tasks = Task::getActiveTasksByAvpId($user_id);
				break;
			case 'exec':
				$tasks = Task::getActiveTasksByExecId($user_id);
				break;
			default:
				$tasks = [];
				break;
		}
		return $tasks;
	}

	public static function getActiveTasksByDistrictManagerId($user_id)
	{
		
		$district_id = UserResource::join('resources', 'resources.id', '=', 'user_resource.resource_id')
									->where('user_id', $user_id)
									->first()->resource_id;

		$stores = StoreInfo::getStoresByDistrictId($district_id);
		

		return Task::compileTasksByStores($stores);
		
	}

	public static function getActiveTasksByAvpId($user_id)
	{
		$region_id = UserResource::join('resources', 'resources.id', '=', 'user_resource.resource_id')
									->where('user_id', $user_id)
									->first()->resource_id;

		$stores = StoreInfo::getStoresByRegionId($region_id);
		
		return Task::compileTasksByStores($stores);
	}

	public static function getActiveTasksByExecId($user_id)
	{

	}

	public static function compileTasksByStores($stores)
	{
		$tasks = Task::getTasksByStoreList($stores);

		$compiledTasks = [];
		foreach ($tasks as $task) {
	        $index = array_search($task['id'], array_column($compiledTasks, 'id'));
	        if(  $index !== false ){
	           array_push($compiledTasks[$index]->stores, $task["store_id"]);
	        }
	        else{
	           
	           $task["stores"] = [];
	           array_push( $task["stores"] , $task["store_id"]);
	           array_push( $compiledTasks , (object) $task);
	        }
        }

		return $compiledTasks;
	}

	public static function getTasksByStoreList($stores)
	{
		return Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
								->whereIn('store_id', $stores)
								->select('tasks.*', 'tasks_target.store_id')
								->get()->toArray();
	}

}
