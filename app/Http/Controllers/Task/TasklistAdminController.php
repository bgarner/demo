<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task\Tasklist;
use App\Models\Task\TasklistTarget;
use App\Models\Utility\Utility;
use App\Models\StoreApi\StoreInfo;
class TasklistAdminController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Tasklist::getTasklists();
        return view('admin.tasklist.index')->with('tasklists', $tasklists);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $storeAndStoreGroups = Utility::getStoreAndStoreGroupList(1);
        return view('admin.tasklist.create')->with('storeAndStoreGroups', $storeAndStoreGroups);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Tasklist::createTasklist($request);
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
        
        $tasklist_target_stores = TasklistTarget::getTargetStoresByTasklistId($id);
        $storeList = StoreInfo::getStoreListing(1);

        $tasklist = Tasklist::getTasklistById($id);
        
        return view('admin.tasklist.edit')->with('tasklist', $tasklist)
                                        ->with('storeList', $storeList)
                                        ->with('target_stores', $tasklist_target_stores);
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
        return Tasklist::updateTasklist($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tasklist::deleteTasklist($id);
    }
}
