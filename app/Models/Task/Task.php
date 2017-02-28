<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\TaskValidator;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskDocument;
use App\Models\Task\TaskStatusTypes;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\UserResource;
use App\Models\StoreInfo;
use Carbon\Carbon;
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

		$description = '';
		if(isset($request['description'])) {
			$description = $request['description'];
		}

		$publish_date = Carbon::now();
		if(isset($request['publish_date'])) {
			$publish_date = $request['publish_date'];
		}
		
		$task = Task::create([
			'title' 		=> $request["title"],
			'description' 	=> $description,
			'publish_date'	=> $publish_date,
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
		$task["due_date"] = $request["due_date"];
		$task["send_reminder"]	= (bool) $request["send_reminder"];
		if(isset($request['description'])) {
			$task["description"] = $request['description'];
		}

		if(isset($request['publish_date'])) {
			$task["publish_date"] = $request['publish_date'];
		}

		$task->save();

		TaskTarget::updateTargetStores($task->id, $request);
		TaskDocument::updateTaskDocuments($task->id, $request);

		return $task;

	}

	public static function deleteTask($id)
	{
		Task::find($id)->delete();
	}
	
	public static function getActiveTasksByUserId($user_id)
	{
		$stores = array_keys(StoreInfo::getStoreListingByManagerId($user_id));
		$tasks = Task::getTasksByStoreList($stores);
		return $tasks;
		
	}


	public static function getTasksByStoreList($stores)
	{
		$tasks =  Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
								->whereIn('store_id', $stores)
								->select('tasks.*', 'tasks_target.store_id')
								->get()->toArray();
	
		$tasks = Task::groupTasksByStores($tasks);

		foreach ($tasks as $task) {
			Task::getTaskCompletionStatistics($task);
			Task::getTaskStatus($task);
		}
		return $tasks;
		
	}

	public static function groupTasksByStores($tasks)
	{
		
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

	public static function getTaskCompletionStatistics($task)
	{	
    	$task->stores_done = TaskStoreStatus::getStoresDone($task->id);
    	$task->stores_not_done = TaskStoreStatus::getStoresNotDone($task->id);
    	$task->percentage_done = round( ((count($task->stores) - count($task->stores_not_done))/count($task->stores))*100 );
    
        return $task;
	}

	public static function getTaskStatus($task)
	{
		
		$publish_date = $task->publish_date;
		$due_date = $task->due_date;
		$today = Carbon::now();

		if($today < $publish_date){
			$task->status = 'Upcoming';
			$task->status_color = TaskStatusTypes::where('status_title', 'Upcoming')->first()->css_class;
		}
		if($today > $publish_date && $today < $due_date)
		{
			$task->status = 'Active';
			$task->status_color = TaskStatusTypes::where('status_title', 'Active')->first()->css_class;
		}
		if($today > $due_date)
		{
			$task->status = 'Passed';
			$task->status_color = TaskStatusTypes::where('status_title', 'Passed')->first()->css_class;
		}
		return $task;


	}


}
