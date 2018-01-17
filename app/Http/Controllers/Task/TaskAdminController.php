<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StoreApi\Banner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Task\Task;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Document\FileFolder;
use App\Models\Task\TaskDocument;
use App\Models\Task\TaskTarget;
use App\Models\Task\TaskStatusTypes;
use App\Models\Utility\Utility;

class TaskAdminController extends Controller
{
    /**
     * Instantiate a new TaskAdminController instance.
     */
    public function __construct()
    {
       //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::getTasksForAdmin();
        return view('admin.task.index')->with('tasks', $tasks);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $optGroupOptions = Utility::getStoreAndBannerSelectDropdownOptions();

        return view('admin.task.create')->with('optGroupOptions', $optGroupOptions)
                                        ->with('navigation', $fileFolderStructure);
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
        $banner = UserSelectedBanner::getBanner();
    
        $optGroupOptions = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections = json_encode(Task::getSelectedStoresAndBannersByTaskId($id));

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $task = Task::find($id);
        $task_documents  = TaskDocument::getDocumentsByTaskId($id);
        $task_status_list = TaskStatusTypes::getTaskStatusList();
        
        return view('admin.task.edit')->with('task', $task)
                                        ->with('task_documents', $task_documents)
                                        ->with('optGroupOptions', $optGroupOptions)
                                        ->with('optGroupSelections', $optGroupSelections)
                                        ->with('navigation', $fileFolderStructure)
                                        ->with('task_status_list', $task_status_list);
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
        return Task::updateTask($id, $request);
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
