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
use App\Models\Auth\User\UserSelectedBanner;

class Tasklist extends Model
{
    use SoftDeletes;

    protected $table = 'tasklists';

    protected $fillable = ['title', 'description', 'banner_id'];

    protected $dates = ['deleted_at'];

    public static function validateCreateTasklist($request)
	{
		$validateThis =  [

			'title'   		=> $request['title'],
			// 'target_stores' => $request['target_stores']

		];

		\Log::info($validateThis);
		$v = new TasklistValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditTasklist($request)
	{	
        $validateThis =  [

			'title'   		 => $request['title'],

		];

		\Log::info($validateThis);
		$v = new TasklistValidator();
		return $v->validate($validateThis);  
	}


    public static function getTasklistsForAdmin()
    {
    	$banner = UserSelectedBanner::getBanner()->id;

        $tasklists = Tasklist::where('banner_id', $banner)
                            ->select('tasklists.*')
                            ->get();

        foreach ($tasklists as $tasklist) {
			$tasklist->prettyDueDate = Utility::prettifyDate($tasklist->due_date);
        }
        
        return $tasklists;

    }

    public static function getAllTasklistsByStore($store_number)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_number)->banner_id;


        $tasklists = Tasklist::where('banner_id', $banner_id)
                            ->select('tasklists.*')
                            ->get();
        
        foreach ($tasklists as $tasklist) {
            // $tasklist->prettyDueDate = Utility::prettifyDate($tasklist->due_date);
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

		$tasklist = Tasklist::create([
				'title' 		=> $request['title'],
				'description' 	=> $request["description"],
                'banner_id'     => UserSelectedBanner::getBanner()->id
			]);


        TasklistTask::updateTasks($tasklist->id, $request);

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
		if(isset($request['description'])) {
			$tasklist["description"] = $request['description'];
		}

		$tasklist->save();
		TasklistTask::updateTasks($tasklist->id, $request);
		return $tasklist;
    }

   

    public static function deleteTasklist($id)
    {    	
    	TasklistTask::where('tasklist_id', $id)->delete();
    	Tasklist::find($id)->delete();
    	return;
    }

    
    public static function getAllIncompleteTasksByTasklistId($tasklist_id, $store_id)
    {
        $task_ids = Self::getTasksForTasklist($tasklist_id);
        return Task::getAllIncompleteTasksByStoreId($store_id, $task_ids);
        

    }

    public static function getTaskDueTodaybyTasklistId($tasklist_id, $store_id)
    {   
        $task_ids = Self::getTasksForTasklist($tasklist_id);
        return Task::getTaskDueTodaybyStoreId($store_id, $task_ids);
    }

    public static function getAllCompletedTasksByTasklistId( $tasklist_id, $store_id)
    {
        $task_ids = Self::getTasksForTasklist($tasklist_id);
        return Task::getAllCompletedTasksByStoreId($store_id, $task_ids = null);
    }

    public static function getTasksForTasklist($tasklist_id)
    {
        $task_ids = Tasklist::join('tasklist_tasks', 'tasklist_tasks.tasklist_id', '=', 'tasklists.id')
                        ->where('tasklists.id', $tasklist_id)
                        ->select('tasklist_tasks.task_id')
                        ->get()
                        ->pluck('task_id')
                        ->toArray();
        return $task_ids;

    }

}
