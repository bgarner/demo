<?php

namespace App\Http\Controllers\Task;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Task\Task;
use App\Models\Task\Tasklist;
use App\Models\Utility\Utility;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $storeNumber = RequestFacade::segment(1);
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);
        $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber);
        $tasksNotDueToday = $allIncompleteTasks->diff($tasksDueToday);
        $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber);
    
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('allIncompleteTasks', $allIncompleteTasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $storeNumber, $id)
    {
        $store_task_status = Task::updateTaskStoreStatus($request, $storeNumber, $id);

        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);
        $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber);
        $tasksNotDueToday = $allIncompleteTasks->diff($tasksDueToday);
        $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber);

        $returnHTML = view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('allIncompleteTasks', $allIncompleteTasks)
                    ->render();

        return response()->json(['html'=>$returnHTML]);
        
    }

    public static function getTasksForStoreByDM($storeNumber)
    {
        $task_ids = Task::getDMTasks($storeNumber);

        $incompleteTasksInList = [];
        $tasksDueToday = [];
        $tasksNotDueToday = [];
        $tasksCompleted = [];

        if($task_ids){
            $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
            $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
            $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
            $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);    
        }
        
        $title = "DM Tasks";
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('title', $title);
        
        
    }

    public static function updateDMTask(Request $request, $storeNumber, $id)
    {
        $store_task_status = Task::updateTaskStoreStatus($request, $storeNumber, $id);
        $task_ids = Task::getDMTasks($storeNumber);

        $incompleteTasksInList = [];
        $tasksDueToday = [];
        $tasksNotDueToday = [];
        $tasksCompleted = [];

        if($task_ids){
            $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
            $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
            $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
            $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);
        }
        $title = "DM Tasks";
        $returnHTML =  view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('title', $title)
                    ->render();


        return response()->json(array('html'=>$returnHTML));

    }

    public static function getTasksForStoreByAVP($storeNumber)
    {
        $task_ids = Task::getAVPTasks($storeNumber);
        
        $incompleteTasksInList = [];
        $tasksDueToday = [];
        $tasksNotDueToday = [];
        $tasksCompleted = [];

        if($task_ids){
            $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
            $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
            $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
            $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);
        }
        else{
            
        }
        $title = "AVP Tasks";
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('title', $title)
                    ->with('incompleteTasksInList', $incompleteTasksInList);
        
    }


    public static function updateAVPTask(Request $request, $storeNumber, $id)
    {
        $store_task_status = Task::updateTaskStoreStatus($request, $storeNumber, $id);
        $task_ids = Task::getAVPTasks($storeNumber);

        $incompleteTasksInList = [];
        $tasksDueToday = [];
        $tasksNotDueToday = [];
        $tasksCompleted = [];

        if($task_ids){
            $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
            $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
            $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
            $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);
        }
        $title = "AVP Tasks";

        $returnHTML =  view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('title', $title)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->render();


        return response()->json(array('html'=>$returnHTML));

    }

}
