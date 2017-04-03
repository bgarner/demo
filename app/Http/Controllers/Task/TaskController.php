<?php

namespace App\Http\Controllers\Task;

use App\Models\Task\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Models\StoreInfo;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get tasks due today for store
        //get tasks due for store arranged reverese chronologically
        $storeNumber = RequestFacade::segment(1);
        $allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($storeNumber);
        $tasksDueToday = Task::getTaskDueTodaybyStoreId($storeNumber);
        $tasksNotDueToday = $allIncompleteTasks->diff($tasksDueToday);
        $tasksCompleted = Task::getAllCompletedTasksByStoreId($storeNumber);
        // dd($completedTasks);
        return view('site.tasks.index')
                    ->with('tasksDueToday', $tasksDueToday)
                    ->with('tasksDue', $tasksNotDueToday)
                    ->with('tasksCompleted', $tasksCompleted);
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
        //get Details of the current task
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
        return Task::updateTaskStoreStatus($request, $storeNumber, $id);
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
