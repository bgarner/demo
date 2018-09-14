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
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
    
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('allIncompleteTasks', $allIncompleteTasks)
                    ->with('tasklists', $tasklists);
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
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);

        $returnHTML = view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('allIncompleteTasks', $allIncompleteTasks)
                    ->with('tasklists', $tasklists)
                    ->render();

        return response()->json(array('html'=>$returnHTML, 
                                    'tasksCompleted'=> count($tasksCompleted), 
                                    'allIncompleteTasks'=> count($allIncompleteTasks)
                                ));
        
    }

    public static function getTasksForStoreByDM($storeNumber)
    {

        $user = Utility::getDMForStore($storeNumber);
        $task_ids = Task::getTasksByUserId($user->id);
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);
        $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
        $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
        $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
        $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = "DM Tasks";
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('tasklists', $tasklists)
                    ->with('title', $title)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('allIncompleteTasks', $allIncompleteTasks);
        
        
    }

    public static function getTasksForStoreByAVP($storeNumber)
    {
        $user = Utility::getAVPForStore($storeNumber);
        $task_ids = Task::getTasksByUserId($user->id);


        
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);
        $incompleteTasksInList = Task::getAllIncompleteTasksByStoreId($storeNumber, $task_ids);
        $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber, $task_ids);
        $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
        $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber, $task_ids);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = "AVP Tasks";
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('tasklists', $tasklists)
                    ->with('title', $title)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('allIncompleteTasks', $allIncompleteTasks);
        
    }

}
