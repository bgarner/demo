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
                    ->with('tasklists', $tasklists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // remove this method
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // remove this method
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // remove this method
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
                    ->render();

        return response()->json(array('html'=>$returnHTML));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // remove this method
    }
}
