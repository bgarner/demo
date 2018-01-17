<?php

namespace App\Http\Controllers\Task;

use App\Models\Task\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Models\StoreApi\StoreInfo;
use App\Models\Task\Tasklist;

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

}
