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
        $allIncompleteTasks = Tasklist::getAllIncompleteTasksByTasklistId($id, $storeNumber);
        $tasksDueToday = Tasklist::getTaskDueTodaybyTasklistId($id, $storeNumber);
        $tasksNotDueToday = $allIncompleteTasks->diff($tasksDueToday);
        $tasksCompleted = Tasklist::getAllCompletedTasksByTasklistId($id, $storeNumber);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = Tasklist::getTasklistById($id)->title;

        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('tasklists', $tasklists)
                    ->with('title', $title);
    }

    public function update(Request $request, $storeNumber, $tasklistId, $taskId)
    {
        $store_task_status = Task::updateTaskStoreStatus($request, $storeNumber, $taskId);

        $allIncompleteTasks = Tasklist::getAllIncompleteTasksByTasklistId($tasklistId, $storeNumber);
        $tasksDueToday = Tasklist::getTaskDueTodaybyTasklistId($tasklistId, $storeNumber);
        $tasksNotDueToday = $allIncompleteTasks->diff($tasksDueToday);
        $tasksCompleted = Tasklist::getAllCompletedTasksByTasklistId($tasklistId, $storeNumber);
        $tasklists = Tasklist::getAllTasklistsByStore($storeNumber);
        $title = Tasklist::getTasklistById($tasklistId)->title;


        $returnHTML = view('site.tasks.task-list-partial')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted)
                    ->with('title', $title)
                    ->render();

        return response()->json(array('html'=>$returnHTML));
        
    }
}
