<?php

namespace App\Models\Task;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\TaskValidator;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskDocument;
use App\Models\Task\TaskStatusTypes;
use App\Models\Task\StoreStatusTypes;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\UserResource;
use App\Models\StoreApi\StoreInfo;
use App\Models\Utility\Utility;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use Carbon\Carbon;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Video\Playlist;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'due_date', 'publish_date', 'send_reminder', 'banner_id'];

    protected $dates = ['deleted_at'];

	public static function validateCreateTask($request)
	{
		$validateThis =  [

			'title'   		=> $request['title']
			// 'target_stores' => explode(',', $request['target_stores'])

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }

        if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banners'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['target_store_groups'] != NULL) {
            $validateThis['target_store_groups'] = $request['target_store_groups'];
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

       	if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banners'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['target_store_groups'] != NULL) {
            $validateThis['target_store_groups'] = $request['target_store_groups'];
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
		$validate = Task::validateCreateTask($request);
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
			'send_reminder'	=> (bool) $request["send_reminder"],
			// 'banner_id'		=> $banner_id
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
	
	public static function getTasksForAdmin()
	{
		
		$banner = UserSelectedBanner::getBanner()->id;

		//stores in accessible banners
        $storeList = [];
        // foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        // }

        $allStoreTasks = Task::join('task_banner', 'task_banner.task_id', '=', 'tasks.id')
                                ->where('all_stores', 1)
                                ->where('task_banner.banner_id', $banner)
                                ->select('tasks.*', 'task_banner.banner_id')
                                ->get();

        $allStoreTasks = Utility::groupBannersForAllStoreContent($allStoreTasks);
        
        $targetedTasks = Task::join('tasks_target', 'tasks_target.task_id', '=', 'tasks.id')
                                ->whereIn('tasks_target.store_id', $storeList)
                                ->select(\DB::raw('tasks.*, GROUP_CONCAT(DISTINCT tasks_target.store_id) as stores'))
                                ->groupBy('tasks.id')
                                ->get()
                                ->each(function($task){
                                    $task->stores = explode(',', $task->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $tasksForStoreGroups = Task::join('task_store_group', 'task_store_group.task_id', '=', 'tasks.id')
                                            ->whereIn('task_store_group.store_group_id', $storeGroups)
                                            ->select('tasks.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = TaskStoreGroup::where('task_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });

        $targetedTasks = Utility::mergeTargetedAndStoreGroupContent($targetedTasks, $tasksForStoreGroups);
                                           
        $tasks = Utility::mergeTargetedAndAllStoreContent($targetedTasks, $allStoreTasks);

        foreach ($tasks as $key=>$task) {
			$task->prettyDueDate = Utility::prettifyDate($task->due_date);
			if(TasklistTask::where('task_id', $task->id)->exists()){
				$tasks->forget($key);
			}
        }
        return $tasks;


	}

	public static function getActiveTasksForStoreList($stores, $banners, $storeGroups)
	{
		
		$allStoreTasks = Task::join('task_banner', 'task_banner.task_id', '=', 'tasks.id')
								->join('task_creator', 'task_creator.task_id', '=', 'tasks.id')
                                ->where('all_stores', 1)
                                ->whereIn('task_banner.banner_id', $banners)
                                ->select(\DB::raw('tasks.*, GROUP_CONCAT(DISTINCT task_banner.banner_id) as banners, task_creator.creator_id'))
                                ->groupBy('tasks.id')
                                ->get()
                                ->each(function($item)use ($stores, $banners){
                                	$item->banners = explode(',', $item->banners);
                                	$item->stores = [];
                                	foreach ($item->banners as $banner) {
                                		$item->stores = array_merge($item->stores, array_column(StoreInfo::getStoresInfo($banner), 'store_number'));
                                	}

                                	$item->stores = array_intersect($item->stores, $stores);
                                	
                                });
        
        $targetedTasks = Task::join('tasks_target', 'tasks_target.task_id', '=', 'tasks.id')
        						->join('task_creator', 'task_creator.task_id', '=', 'tasks.id')
                                ->whereIn('tasks_target.store_id', $stores)
                                ->select(\DB::raw('tasks.*, GROUP_CONCAT(DISTINCT tasks_target.store_id) as stores, task_creator.creator_id'))
                                ->groupBy('tasks.id')
                                ->get()
                                ->each(function($task){
                                    $task->stores = explode(',', $task->stores);
                                });

        $tasksForStoreGroups = Task::join('task_store_group', 'task_store_group.task_id', '=', 'tasks.id')
        							->join('task_creator', 'task_creator.task_id', '=', 'tasks.id')
                                    ->whereIn('task_store_group.store_group_id', $storeGroups)
                                    ->select(\DB::raw('tasks.*, GROUP_CONCAT(DISTINCT task_store_group.store_group_id) as store_groups, task_creator.creator_id'))
                                    ->groupBy('tasks.id')
                                    ->get()
                                    ->each(function($item)use ($stores){
                                        $store_groups = explode(',', $item->store_groups);
                                        $item->store_groups = $store_groups;
                                        $group_stores = [];
                                        foreach ($store_groups as $group) {
                                            $temp_stores = unserialize(CustomStoreGroup::find($group)->stores);
                                            $group_stores = array_merge($group_stores,$temp_stores);
                                        }
                                        $group_stores = array_unique( $group_stores);
                                        $item->stores = array_intersect($stores, $group_stores);
                                    });


        $allTasks = $targetedTasks->merge($tasksForStoreGroups)->merge($allStoreTasks)->sortByDesc('due_date')
        ->each(function($task){
        	Task::getTaskCompletionStatisticsForManager($task);
			Task::getTaskStatus($task);
			$task->prettyDueDate = Utility::prettifyDate($task->due_date);
			if(TasklistTask::where('task_id', $task->id)->exists()){
				$tasks->forget($key);
			}
        });
                                           

        return $allTasks;
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

	public static function getTaskCompletionStatisticsForManager($task)
	{	
    	
    	$allStoresDone = TaskStoreStatus::getStoresDone($task->id);
    	$taskStores = $task->stores;

    	$storesDone = array_intersect($allStoresDone, $taskStores);
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

	public static function getAllIncompleteTasksByStoreId($store_id, $tasklist_id = null)
	{
		$now = Carbon::now()->format('Y-m-d H:i:s');
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

		$allStoreTasks = Task::join('task_banner', 'task_banner.task_id', '=', 'tasks.id')
							->where('all_stores', 1)
							->where('tasks.publish_date', '<=', $now)
							->where('task_banner.banner_id', $banner_id)
							->select('tasks.*')
							->get()
							->each(function($task, $store_id){
								$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
								$task->store_id = $store_id;
							});


		$targetedTasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->where('tasks.publish_date', '<=', $now)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
					});

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);

        $targetedTasksForStoreGroups = Task::join('task_store_group', 'task_store_group.task_id', '=', 'tasks.id')
        									->where('tasks.publish_date', '<=', $now)
                                            ->whereIn('task_store_group.store_group_id', $storeGroups)
                                            ->select('tasks.*')
                                            ->get()
                                            ->each(function($task, $store_id){
												$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
												$task->store_id = $store_id;
											});
	
		$tasks = $targetedTasks->merge($allStoreTasks);
		$tasks = $tasks->merge($targetedTasksForStoreGroups);

		foreach ($tasks as $key => $task) {
			
			$isTaskDoneByStore = Self::isTaskDoneByStore($task->id, $store_id);
			
			if($isTaskDoneByStore){
				$tasks->forget($key);
			}
			if(TaskDocument::where('task_id', $task->id)->exists()){
				$task->documents = TaskDocument::join('documents', 'task_document.document_id', '=', 'documents.id')
										->where('task_id', $task->id)
										->select('documents.*')
										->get()
										->each(function($doc){
											$doc->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
										});


			}

		}
		return $tasks;

	}

	public static function getTaskDueTodaybyStoreId($store_id, $tasklist_id = null)
	{
		$endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

		$allStoreTasks = $tasks = Task::join('task_banner', 'task_banner.task_id', '=', 'tasks.id')
									->where('tasks.all_stores', 1)
									->where('task_banner.banner_id', $banner_id)
									->where('due_date' , "<=", $endOfDayToday)
									->select('tasks.*')
									->get()
									->each(function($task, $store_id){
										$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
										$task->store_id = $store_id;
										
									});

		$tasks = Task::join('tasks_target', 'tasks.id', '=', 'tasks_target.task_id')
					->where('tasks_target.store_id', $store_id)
					->where('due_date' , "<=", $endOfDayToday)
					->select('tasks.*', 'tasks_target.store_id')
					->get()
					->each(function($task){
						$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
						
					});

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);

        $targetedTasksForStoreGroups = Task::join('task_store_group', 'task_store_group.task_id', '=', 'tasks.id')
                                            ->whereIn('task_store_group.store_group_id', $storeGroups)
                                            ->where('due_date' , "<=", $endOfDayToday)
                                            ->select('tasks.*')
                                            ->get()
                                            ->each(function($task, $store_id){
												$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
												$task->store_id = $store_id;
											});

		$tasks = $tasks->merge($allStoreTasks);
		$tasks = $tasks->merge($targetedTasksForStoreGroups);

		foreach ($tasks as $key=>$task) {

			$isTaskDoneByStore = Self::isTaskDoneByStore($task->id, $store_id);
			
			if($isTaskDoneByStore){
				$tasks->forget($key);
			}
			if(TaskDocument::where('task_id', $task->id)->exists()){
				$task->documents = TaskDocument::join('documents', 'task_document.document_id', '=', 'documents.id')
										->where('task_id', $task->id)
										->select('documents.*')
										->get()
										->each(function($doc){
											$doc->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
										});


			}
		}

		return $tasks;
	}

	public static function getAllCompletedTasksByStoreId($store_id, $tasklist_id = null)
	{
		$banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
		$endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');

		$now = Carbon::now()->format('Y-m-d H:i:s');
		$dayAgo =  Carbon::now()->subDay()->format('Y-m-d H:i:s');

		$allStoreTasks = $tasks = Task::join('task_banner', 'task_banner.task_id', '=', 'tasks.id')
									->join('task_store_status' , 'task_store_status.task_id' , '=', 'tasks.id' )
									->where('all_stores', 1)
									->where('task_banner.banner_id', $banner_id)
									->where('task_store_status.store_id', $store_id)
									->where('task_store_status.status_type_id', '2')
									->where(function($q) use ($endOfDayToday, $now, $dayAgo, $store_id) {
						                $q->where(function($query) use ($endOfDayToday){
						                        $query->where('due_date' , ">=", $endOfDayToday);
					                    })
					                  	->orWhere(function($query) use ($now, $dayAgo, $store_id){
					                        $query->where('task_store_status.status_type_id', '2')
					                        ->where('task_store_status.store_id', $store_id)
					                        ->whereBetween('task_store_status.created_at', [$dayAgo, $now]);
					                        
					                    });
						            })
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
					->where(function($q) use ($endOfDayToday, $now, $dayAgo, $store_id) {
		                $q->where(function($query) use ($endOfDayToday){
		                        $query->where('due_date' , ">=", $endOfDayToday);
	                    })
	                  	->orWhere(function($query) use ($now, $dayAgo, $store_id){
	                        $query->where('task_store_status.status_type_id', '2')
	                        ->where('task_store_status.store_id', $store_id)
	                        ->whereBetween('task_store_status.created_at', [$dayAgo, $now]);
	                    });
		            })
					->select('tasks.*', 'tasks_target.store_id', 'task_store_status.created_at as completed_on')
					->get()
					->each(function($task){
						$task->pretty_due_date = Utility::prettifyDate($task->due_date);
						$task->pretty_completed_date = "Completed on " . Utility::prettifyDate($task->completed_on);
					});

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);

        $targetedTasksForStoreGroups = Task::join('task_store_group', 'task_store_group.task_id', '=', 'tasks.id')
                                            ->join('task_store_status' , 'task_store_status.task_id' , '=', 'tasks.id' )
                                            ->whereIn('task_store_group.store_group_id', $storeGroups)
                                            ->where('task_store_status.status_type_id', '2')
                                            ->where(function($q) use ($endOfDayToday, $now, $dayAgo, $store_id) {
								                $q->where(function($query) use ($endOfDayToday){
								                        $query->where('due_date' , ">=", $endOfDayToday);
							                    })
							                  	->orWhere(function($query) use ($now, $dayAgo, $store_id){
							                        $query->where('task_store_status.status_type_id', '2')
							                        ->where('task_store_status.store_id', $store_id)
							                        ->whereBetween('task_store_status.created_at', [$dayAgo, $now]);
							                    });
								            })
											->select('tasks.*', 'task_store_status.created_at as completed_on')
											->get()
                                            ->each(function($task, $store_id){
												$task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
												$task->store_id = $store_id;
												$task->pretty_completed_date = "Completed on " . Utility::prettifyDate($task->completed_on);
											});
		

		$tasks = $tasks->merge($allStoreTasks);
		$tasks = $tasks->merge($targetedTasksForStoreGroups);


		foreach ($tasks as $task) {
			if(TaskDocument::where('task_id', $task->id)->exists()){
				$task->documents = TaskDocument::join('documents', 'task_document.document_id', '=', 'documents.id')
										->where('task_id', $task->id)
										->select('documents.*')
										->get()
										->each(function($doc){
											$doc->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
										});


			}
		}
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

	public static function getSelectedStoresAndBannersByTaskId($task_id)
    {
        $targetBanners = TaskBanner::where('task_id', $task_id)->get()->pluck('banner_id')->toArray();
        $targetStores = TaskTarget::where('task_id', $task_id)->get()->pluck('store_id')->toArray();
        $storeGroups = TaskStoreGroup::where('task_id', $task_id)->get()->pluck('store_group_id')->toArray();

        $optGroupSelections = [];
        foreach ($targetBanners as $banner) {
            array_push($optGroupSelections, 'banner'.$banner);
        }
        foreach ($targetStores as $stores) {
            array_push($optGroupSelections, 'store'.$stores);   
        }
        foreach ($storeGroups as $group) {
            array_push($optGroupSelections, 'storegroup'.$group);   
        }

        return( $optGroupSelections );
    }

}
