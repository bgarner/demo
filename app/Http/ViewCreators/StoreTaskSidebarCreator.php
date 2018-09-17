<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\Task\Task;
use App\Models\Task\Tasklist;


class StoreTaskSidebarCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $allIncompleteTasks;
    protected $tasklists;
    protected $dmTasks;
    protected $incompleteDMTasks;
    protected $avpTasks;
    protected $incompleteAVPTasks;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->storeNumber = RequestFacade::segment(1);
        $this->allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($this->storeNumber);
        $this->tasklists = Tasklist::getAllTasklistsByStore($this->storeNumber);
        $this->dmTasks = Task::getDMTasks($this->storeNumber);
        $this->incompleteDMTasks = Task::getAllIncompleteTasksByStoreId($this->storeNumber, $this->dmTasks);
        $this->avpTasks = Task::getAVPTasks($this->storeNumber);
        $this->incompleteAVPTasks = Task::getAllIncompleteTasksByStoreId($this->storeNumber, $this->avpTasks);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allIncompleteTasks', $this->allIncompleteTasks)
            ->with('tasklists', $this->tasklists)
            ->with('incompleteDMTasks', $this->incompleteDMTasks)
            ->with('incompleteAVPTasks', $this->incompleteAVPTasks);
    }
}