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
			'target_stores' => $request['target_stores']

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }

        if ($request['banner_id'] != NULL) {
            $validateThis['banner_id'] = $request['banner_id'];
        }

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
			'target_stores'  => $request['target_stores'],
			'status_type_id' => $request['status_type_id']

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }
        if ($request['banner_id'] != NULL) {
            $validateThis['banner_id'] = $request['banner_id'];
        }

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
		
		$banner_id = null;
		if(isset($request['banner_id'])) {
			$banner_id = $request['banner_id'];
		}

		$task = Task::create([
			'title' 		=> $request["title"],
			'description' 	=> $description,
			'publish_date'	=> $publish_date,
			'due_date'		=> $request["due_date"],
			'send_reminder'	=> (bool) $request["send_reminder"],
			'banner_id'		=> $banner_id
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

	public static function updateTaskStoreStatus($request, $storeNumber, $task_id)
	{
		$store_status = TaskStoreStatus::where('task_id', $task_id)->where('store_id', $storeNumber)->first();
		$updatedStatus = StoreStatusTypes::getTaskStatusTypeId($request->current_task_status);
		if($store_status){
			$store_status['status_type_id'] = $updatedStatus->id;
			$store_status->save();
			return $store_status;
		}
		else{
			
			return TaskStoreStatus::create([
				'store_id' => $storeNumber,
				'task_id'  => $task_id,
				'status_type_id' => $updatedStatus->id
				]);
		}
		
	}

	public static function deleteTask($task_id)
	{
		Task::find($task_id)->delete();
	}
	
	public static function getActiveTasksByUserId($user_id)
	{
		$storeInfo = StoreInfo::getStoreListingByManagerId($user_id);
        
        $allStoreTasks = Self::getAllStoreTasksForStoreList($storeInfo);
 
		$stores = array_column($storeInfo, 'store_number');
		$tasks = Task::getTasksByStoreList($stores);

		foreach ($allStoreTasks as $task) {
			array_push( $tasks , (object) $task);
		}
		
		return $tasks;
		
	}

	public static function getAllStoreTasksForStoreList($stores)
	{
		$allStoreTasks = Task::where('all_stores', 1)->get();
		$storesGroupedByBannerId = Self::groupStoresByBannerId($stores);

		foreach ($allStoreTasks as $task) {
			$task['stores'] = $storesGroupedByBannerId[$task->banner_id];
			Task::getTaskCompletionStatistics($task);
			Task::getTaskStatus($task);
		}

		return $allStoreTasks;
	} 

	

	public static function getTasksByStoreList($stores)
	{
		$tasks =  Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
								->whereIn('store_id', $stores)
								->select('tasks.*', 'tasks_target.store_id')
								->get()->toArray();
	
		$tasks = Task::groupTaskStores($tasks);

		foreach ($tasks as $task) {
			Task::getTaskCompletionStatistics($task);
			Task::getTaskStatus($task);
		}
		return $tasks;
		
	}

	public static function groupTaskStores($tasks)
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
    	
    	$storesDone = TaskStoreStatus::getStoresDone($task->id);
    	$taskStores = $task->stores;
    	$storesNotDone = array_diff($taskStores , $storesDone);
    	
    	$task->stores_done = $storesDone;
    	$task->stores_not_done = $storesNotDone;
    	$task->percentage_done = round( ((count($taskStores) - count($storesNotDone))/count($taskStores))*100 );
    
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
		
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

		$allStoreTasks = Task::where('all_stores', 1)
							->where('banner_id', $banner_id)
							->get()
							->each(function($task, $store_id){
								$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
								$task->store_id = $store_id;
							});


		$targetedTasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
					});
	
		$tasks = $targetedTasks->merge($allStoreTasks);

		foreach ($tasks as $key => $task) {
			
			$isTaskDoneByStore = Self::isTaskDoneByStore($task->id, $store_id);
			
			if($isTaskDoneByStore){
				$tasks->forget($key);
			}

		}
		return $tasks;

	}

	public static function getTaskDueTodaybyStoreId($store_id)
	{
		$endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

		$allStoreTasks = $tasks = Task::where('all_stores', 1)
									->where('banner_id', $banner_id)
									->where('due_date' , "<", $endOfDayToday)
									->select('tasks.*')
									->get()
									->each(function($task, $store_id){
										$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
										$task->store_id = $store_id;
										
									});

		$tasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->where('due_date' , "<", $endOfDayToday)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
						
					});

		$tasks = $tasks->merge($allStoreTasks);

		foreach ($tasks as $key=>$task) {

			$isTaskDoneByStore = Self::isTaskDoneByStore($task->id, $store_id);
			
			if($isTaskDoneByStore){
				$tasks->forget($key);
			}
		}

		return $tasks;
	}

	public static function getAllCompletedTasksByStoreId($store_id)
	{
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

		$allStoreTasks = $tasks = Task::join('task_store_status' , 'task_store_status.task_id' , '=', 'tasks.id' )
									->where('all_stores', 1)
									->where('banner_id', $banner_id)
									->where('task_store_status.store_id', $store_id)
									->where('task_store_status.status_type_id', '2')
									->select('tasks.*', 'task_store_status.created_at as completed_on')
									->get()
									->each(function($task, $store_id){
										$task->store_id = $store_id;
										$task->pretty_due_date = Utility::prettifyDate($task->due_date);
										$task->pretty_completed_date = "Completed on " . Utility::prettifyDate($task->completed_on);
									});


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

		$tasks = $tasks->merge($allStoreTasks);
		return $tasks;
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

	public static function isTaskDoneByStore($task_id, $store_id)
	{
		$storeTaskStatus = TaskStoreStatus::where('task_id', $task_id)
											->where('status_type_id', '2')
											->where('store_id', $store_id)
											->first();
		if($storeTaskStatus)
		{
			return true;
		}
		return false;
	}

	public static function groupStoresByBannerId($storeInfo)
	{
		$compiledStores = [];
		foreach ($storeInfo as $store) {

			$currentBannerId = $store->banner_id;
	        $index = array_search($currentBannerId, array_keys($compiledStores));
	        if(  $index !== false ){
	           array_push($compiledStores[$currentBannerId], $store->store_number);
	        }
	        else{
	           $compiledStores[$currentBannerId] = [];
	           array_push( $compiledStores[$currentBannerId] ,  $store->store_number);
	        }

        }

        return $compiledStores;
	}


}
