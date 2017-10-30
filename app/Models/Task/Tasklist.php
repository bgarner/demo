<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\TasklistValidator;
use App\Models\Utility\Utility;
use Carbon\Carbon;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Video\Playlist;

class Tasklist extends Model
{
    use SoftDeletes;

    protected $table = 'tasklists';

    protected $fillable = ['title', 'description', 'due_date', 'publish_date'];

    protected $dates = ['deleted_at'];

    public static function validateCreateTasklist($request)
	{
		$validateThis =  [

			'title'   		=> $request['title'],
			// 'target_stores' => $request['target_stores']

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
        if ($request['store_groups'] != NULL) {
            $validateThis['store_groups'] = $request['store_groups'];
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

			'title'   		 => $request['title']

		];
		if ($request['due_date'] != NULL) {
            $validateThis['due_date'] = $request['due_date'];
        }
        if ($request['publish_date'] != NULL) {
            $validateThis['publish_date'] = $request['publish_date'];
        }

		if(isset($request['remove_tasks'])){
			$validateThis['remove_tasks'] = $request['remove_tasks'];
		}
		if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banners'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['store_groups'] != NULL) {
            $validateThis['store_groups'] = $request['store_groups'];
        }

		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		\Log::info($validateThis);
		$v = new TasklistValidator();
		return $v->validate($validateThis);  
	}


    public static function getTasklistsForAdmin()
    {
    	$banners = UserBanner::getAllBanners()->pluck('id')->toArray();

		//stores in accessible banners
        $storeList = [];
        foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        }

        $allStoreTasklists = Tasklist::join('tasklist_banner', 'tasklist_banner.tasklist_id', '=', 'tasklists.id')
                                ->where('all_stores', 1)
                                ->whereIn('tasklist_banner.banner_id', $banners)
                                ->select('tasklists.*', 'tasklist_banner.banner_id')
                                ->get();

        $allStoreTasklists = Utility::groupBannersForAllStoreContent($allStoreTasklists);
        
        $targetedTasklists = Tasklist::join('tasklist_target', 'tasklist_target.tasklist_id', '=', 'tasklists.id')
                                ->whereIn('tasklist_target.store_id', $storeList)
                                ->select(\DB::raw('tasklists.*, GROUP_CONCAT(DISTINCT tasklist_target.store_id) as stores'))
                                ->groupBy('tasklists.id')
                                ->get()
                                ->each(function($event){
                                    $event->stores = explode(',', $event->stores);
                                });


        $targetedTasklists = Tasklist::groupTasklistStores($targetedTasklists);

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $tasklistsForStoreGroups = Tasklist::join('tasklist_store_group', 'tasklist_store_group.tasklist_id', '=', 'tasklists.id')
                                            ->whereIn('tasklist_store_group.store_group_id', $storeGroups)
                                            ->select('tasklists.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = TasklistStoreGroup::where('tasklist_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });

        $targetedTasklists = Tasklist::mergeTargetedAndStoreGroupTasklists($targetedTasklists, $tasklistsForStoreGroups);
                                           
        $tasklists = Utility::mergeTargetedAndAllStoreContent($targetedTasklists, $allStoreTasklists);

        foreach ($tasklists as $tasklist) {
			$tasklist->prettyDueDate = Utility::prettifyDate($tasklist->due_date);
        }
        
        return $tasklists;

    }

    public static function getAllTasklistsByStore($store_number)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_number)->banner_id;


        $allStoreTasklists = Tasklist::join('tasklist_banner', 'tasklist_banner.tasklist_id', '=', 'tasklists.id')
                                ->where('all_stores', 1)
                                ->where('tasklist_banner.banner_id', $banner_id)
                                ->select('tasklists.*')
                                ->get();
        
        $targetedTasklists = Tasklist::join('tasklist_target', 'tasklist_target.tasklist_id', '=', 'tasklists.id')
                                ->where('tasklist_target.store_id', $store_number)
                                ->select('tasklists.*')
                                ->get();


        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_number);

        $tasklistsForStoreGroups = Tasklist::join('tasklist_store_group', 'tasklist_store_group.tasklist_id', '=', 'tasklists.id')
                                            ->whereIn('tasklist_store_group.store_group_id', $storeGroups)
                                            ->select('tasklists.*')
                                            ->get();
                                            

        
        $tasklists = $allStoreTasklists->merge($targetedTasklists)->merge($tasklistsForStoreGroups);
        foreach ($tasklists as $tasklist) {
            $tasklist->prettyDueDate = Utility::prettifyDate($tasklist->due_date);
            $tasklist->incompleteTasksInList = Tasklist::getAllIncompleteTasksByTasklistId($tasklist->id, $store_number);

        }
        
        return $tasklists;
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


    public static function createTaskList($request)
    {

		$validate = Tasklist::validateCreateTasklist($request);
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

        if ($request['tasks'] != NULL) {
    		foreach ($request->tasks as $task) {

    			$request['title'] = $task;
    			$request['send_reminder'] = NULL;
    			$task = Task::createTask($request);
    			
    			//task is a json string if the validation fails while creating task.
    			//if task is not created, tasklist-task map need not exist. 
    			if(!is_string($task)){ 
    				
    				TasklistTask::create([
    					'tasklist_id' => $tasklist->id,
    					'task_id'	=> $task->id
    				]);	
    			}
    		}
		}
		return $tasklist;
    }

    public static function updateTasklist($request, $id)
    {
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

   

    public static function deleteTasklist($id)
    {
    	
    	$tasks = Task::join('tasklist_tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
    				->where('tasklist_tasks.tasklist_id', $id)
    				->select('tasks.*')
    				->get();
    	foreach ($tasks as $task) {
    		Task::find($task->id)->delete();
    	}
    	Tasklist::find($id)->delete();
    	return;
    }

    public static function groupTasklistStores($tasklists)
	{
		$tasklists = $tasklists->toArray();
		$compiledTasklists = [];
		foreach ($tasklists as $tasklist) {
	        $index = array_search($tasklist['id'], array_column($compiledTasklists, 'id'));
	        if(  $index !== false ){
	           array_push($compiledTasklists[$index]->stores, $tasklist["store_id"]);
	        }
	        else{
	           
	           $tasklist["stores"] = [];
	           array_push( $tasklist["stores"] , $tasklist["store_id"]);
	           array_push( $compiledTasklists , (object) $tasklist);
	        }

        }
        
		return collect($compiledTasklists);
	}

	public static function mergeTargetedAndStoreGroupTasklists($targetedTasklists, $storeGroupTasklists)
    {
        $targetedTasklistsArray = $targetedTasklists->toArray();
        $targetedTasklistIds = array_column($targetedTasklistsArray, 'id');
        foreach ($storeGroupTasklists as $tasklist) {

            if(in_array($tasklist->id, $targetedTasklistIds)){
                $targetedTasklistStores = $targetedTasklists->where('id', $tasklist->id)->first()->stores;
                $mergedStores = array_merge( $targetedTasklistStores, $tasklist->stores);
                $targetedTasklists->where('id', $tasklist->id)->first()->stores = $mergedStores;
            }
            else{

                $targetedTasklists = $targetedTasklists->push((object)$tasklist);                
            }
        }
        return $targetedTasklists;

    }

	public static function getSelectedStoresAndBannersByTasklistId($tasklist_id)
    {
        $targetBanners = TasklistBanner::where('tasklist_id', $tasklist_id)->get()->pluck('banner_id')->toArray();
        $targetStores = TasklistTarget::where('tasklist_id', $tasklist_id)->get()->pluck('store_id')->toArray();
        $storeGroups = TasklistStoreGroup::where('tasklist_id', $tasklist_id)->get()->pluck('store_group_id')->toArray();

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

    
    public static function getAllIncompleteTasksByTasklistId($tasklist_id, $store_id)
    {
        
        
        $tasks = Tasklist::join('tasklist_tasks', 'tasklist_tasks.tasklist_id', '=', 'tasklists.id')
                        ->join('tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
                        ->where('tasklists.id', $tasklist_id)
                        ->select('tasks.*')
                        ->get()
                        ->each(function($task){
                            $task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
                        });

        foreach ($tasks as $key => $task) {
            
            $isTaskDoneByStore = Task::isTaskDoneByStore($task->id, $store_id);
            
            if($isTaskDoneByStore){
                $tasks->forget($key);
            }

        }
        return ( $tasks );

    }

    public static function getTaskDueTodaybyTasklistId($tasklist_id, $store_id)
    {
        $endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');

        $tasks = Tasklist::join('tasklist_tasks', 'tasklist_tasks.tasklist_id', '=', 'tasklists.id')
                        ->join('tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
                        ->where('tasklists.id', $tasklist_id)
                        ->where('tasklists.due_date' , "<=", $endOfDayToday)
                        ->select('tasks.*')
                        ->get()
                        ->each(function($task){
                            $task->pretty_due_date = Task::getTaskPrettyDueDate($task->due_date);
                            
                        });

        foreach ($tasks as $key=>$task) {

            $isTaskDoneByStore = Task::isTaskDoneByStore($task->id, $store_id);
            
            if($isTaskDoneByStore){
                $tasks->forget($key);
            }
        }

        return( $tasks );
    }

    public static function getAllCompletedTasksByTasklistId( $tasklist_id, $store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        $endOfDayToday = Carbon::today()->endOfDay()->format('Y-m-d H:i:s');


        $tasks = Tasklist::join('tasklist_tasks', 'tasklist_tasks.tasklist_id', '=', 'tasklists.id')
                        ->join('tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
                        ->join('task_store_status' , 'task_store_status.task_id' , '=', 'tasks.id' )
                        ->where('tasklists.id', $tasklist_id)
                        ->where('task_store_status.store_id', $store_id)
                        ->where('task_store_status.status_type_id', '2')
                        ->select('tasks.*', 'task_store_status.created_at as completed_on')
                        ->get()
                        ->each(function($task){
                            $task->pretty_due_date = Utility::prettifyDate($task->due_date);
                            $task->pretty_completed_date = "Completed on " . Utility::prettifyDate($task->completed_on);
                        });

        return ( $tasks );
    }
}
