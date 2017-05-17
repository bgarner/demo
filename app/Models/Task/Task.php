<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\TaskValidator;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskDocument;
use App\Models\Task\TaskStatusTypes;
use App\Models\Task\StoreStatusTypes;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\UserResource;
use App\Models\StoreInfo;
use App\Models\Utility\Utility;
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
			'target_stores' => $request['target_stores']

		];
		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		if(isset($request['task_documents'])){
			$validateThis['documents'] = $request['task_documents'];
		}

		\Log::info($validateThis);
		$v = new TaskValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditTask($request)
	{
		$validateThis =  [

			'title'   		 => $request['title'],
			'publish_date'   => $request['publish_date'],
			'due_date'       => $request['due_date'],
			'target_stores'  => $request['target_stores'],
			'status_type_id' => $request['status_type_id']

		];
		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		if(isset($request['task_documents'])){
			$validateThis['documents'] = $request['task_documents'];
		}
		if(isset($request['remove_document'])){
			$validateThis['remove_document'] = $request['remove_document'];
		}

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

	public static function updateTaskStoreStatus($request, $storeNumber, $id)
	{
		$store_status = TaskStoreStatus::where('task_id', $id)->where('store_id', $storeNumber)->first();
		$updatedStatus = StoreStatusTypes::getTaskStatusTypeId($request->current_task_status);
		if($store_status){
			$store_status['status_type_id'] = $updatedStatus->id;
			$store_status->save();
			return $store_status;
		}
		else{
			
			return TaskStoreStatus::create([
				'store_id' => $storeNumber,
				'task_id'  => $id,
				'status_type_id' => $updatedStatus->id
				]);
		}
		
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
		if($today > $publish_date && ($today < $due_date || $due_date == '0000-00-00 00:00:00'))
		{
			$task->status = 'Active';
			$task->status_color = TaskStatusTypes::where('status_title', 'Active')->first()->css_class;
		}
		if( ($due_date != '0000-00-00 00:00:00') && $today > $due_date)
		{
			$task->status = 'Passed';
			$task->status_color = TaskStatusTypes::where('status_title', 'Passed')->first()->css_class;
		}
		return $task;


	}

	public static function getAllIncompleteTasksByStoreId($store_id)
	{
		$tasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
					});


		foreach ($tasks as $key => $task) {
			if(TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', '2')->first()){
				$tasks->forget($key);

			}

			if(TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', '1' )->first()){
				$task->task_status_id = TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', "!=", '2' )->first()->status_type_id;
				$task->status_title = TaskStoreStatus::join('task_store_status_types', 'task_store_status_types.id', '=', 'task_store_status.task_id')
													->where('task_id', $task->id)
													->select('task_store_status_types.status_title')
													->first();
			}
		}
		return $tasks;

	}

	public static function getTaskDueTodaybyStoreId($store_id)
	{
		$endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');

		$tasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->where('due_date' , "<", $endOfDayToday)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
						
					});
		foreach ($tasks as $key=>$task) {
			if(TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', '2')->first()){
				$tasks->forget($key);

			}

			if(TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', '1' )->first()){
				$task->task_status_id = TaskStoreStatus::where('task_id', $task->id)->where('status_type_id', "!=", '2' )->first()->status_type_id;
				$task->status_title = TaskStoreStatus::join('task_store_status_types', 'task_store_status_types.id', '=', 'task_store_status.task_id')
													->where('task_id', $task->id)
													->select('task_store_status_types.status_title')
													->first();

			}
		}

		return $tasks;
	}

	public static function getAllCompletedTasksByStoreId($store_id)
	{
		$tasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->join('task_store_status' , 'task_store_status.task_id' , '=', 'tasks.id' )
					->where('tasks_target.store_id', $store_id)
					->where('task_store_status.store_id', $store_id)
					->where('task_store_status.status_type_id', '2')
					->select('tasks.*', 'tasks_target.store_id', 'task_store_status.created_at as completed_on')
					->get()
					->each(function($task){
						$task->pretty_due_date = Utility::prettifyDate($task->due_date);
						$task->pretty_completed_date = "Completed on " . Utility::prettifyDate($task->completed_on);
					});
		return $tasks;
	}


	public static function getTaskCount($store_id)
	{
		return count( Task::getTaskDueTodaybyStoreId($store_id) );
	}

	public static function getTaskPrettyDueDate($due_date)
	{

		$due_date = Carbon::createFromFormat('Y-m-d H:i:s', $due_date)->endOfDay();
		$today = Carbon::today()->endOfDay();
		$diff = $today->diffInDays($due_date, false);

		if($diff == 0){
			return "Due Today";
		}
		else if($diff < 0){
			return abs($diff) . " days overdue";
		}
		else if($diff <= 7){
			return "due in ". $diff . " days";
		}
		else if($diff > 7){
			return "due on " . Utility::prettifyDate($due_date);
		}
		
	}


}
