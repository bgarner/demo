<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task\Tasklist;
use App\Models\Task\Task;

class TasklistController extends Controller
{

    public function index($storeNumber, $id)
    {
        $incompleteTasksInList = Tasklist::getAllIncompleteTasksByTasklistId($id, $storeNumber);
        $tasksDueToday = Tasklist::getTaskDueTodaybyTasklistId($id, $storeNumber);
        $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
        $tasksCompleted = Tasklist::getAllCompletedTasksByTasklistId($id, $storeNumber);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = Tasklist::getTasklistById($id)->title;
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);

        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('tasklists', $tasklists)
                    ->with('title', $title)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('allIncompleteTasks', $allIncompleteTasks);
    }

    public function update(Request $request, $storeNumber, $tasklistId, $taskId)
    {
        $store_task_status = Task::updateTaskStoreStatus($request, $storeNumber, $taskId);

        $incompleteTasksInList = Tasklist::getAllIncompleteTasksByTasklistId($tasklistId, $storeNumber);
        $tasksDueToday = Tasklist::getTaskDueTodaybyTasklistId($tasklistId, $storeNumber);
        $tasksNotDueToday = $incompleteTasksInList->diff($tasksDueToday);
        $tasksCompleted = Tasklist::getAllCompletedTasksByTasklistId($tasklistId, $storeNumber);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = Tasklist::getTasklistById($tasklistId)->title;
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);


        $returnHTML = view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('title', $title)
                    ->with('tasklists', $tasklists)
                    ->with('incompleteTasksInList', $incompleteTasksInList)
                    ->with('allIncompleteTasks', $allIncompleteTasks)
                    ->render();

        return response()->json(array('html'=>$returnHTML, 
                                    'tasksCompleted'=> count($tasksCompleted), 
                                    'allIncompleteTasks'=> count($allIncompleteTasks)
                                ));
        
    }
}
