<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Task\Task;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskStoreStatus;

class TaskManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user_id = \Auth::user()->id;
        $storeInfo = StoreInfo::getStoreListingByManagerId($user_id);
        $storeList = [];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_number . " - " . $store->name;
        }
        
        $tasks = Task::getActiveTasksByUserId($user_id);
        return view('manager.task.index')->with('tasks', $tasks)
                                        ->with('stores', $storeList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Task::createTask($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = \Auth::user()->id;
        $task = Task::find($id);
        $task["stores"] = TaskTarget::where('task_id', $id)->get()->pluck('store_id')->toArray();
        $storeInfo = StoreInfo::getStoreListingByManagerId($user_id);
        $storeList = [];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_number . " - " . $store->name;
        }
        return view('manager.task.edit')->with('task', $task)
                                        ->with('stores', $storeList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Task::updateTask($id, $request);
        return redirect('/manager/task/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::deleteTask($id);
    }
}
