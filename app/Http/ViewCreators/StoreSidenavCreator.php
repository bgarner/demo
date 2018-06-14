<?php
namespace App\Http\ViewCreators;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Alert\Alert;
use App\Models\Communication\Communication;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Task\Task;
use App\Models\StoreComponent\StoreComponent;
use App\Models\Form\Form;
use App\Models\Form\FormTarget;

class StoreSidenavCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $storeNumber;
    protected $alertCount;
    protected $communicationCount;
    protected $urgentNoticeCount;
    protected $taskCount;
    protected $components;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->storeNumber        = RequestFacade::segment(1);
        $this->alertCount         = Alert::getActiveAlertCountByStore($this->storeNumber);
        $this->communicationCount = Communication::getActiveCommunicationCount($this->storeNumber);
        $this->urgentNoticeCount  = UrgentNotice::getUrgentNoticeCount($this->storeNumber);
        $this->allIncompleteTasks = Task::getAllIncompleteTasksByStoreId($this->storeNumber)->count();
        $this->allCompletedTasks  = Task::getAllCompletedTasksByStoreId($this->storeNumber)->count();
        $this->components         = StoreComponent::getComponents($this->storeNumber);        
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('alertCount', $this->alertCount)
            ->with('communicationCount', $this->communicationCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('incompleteTaskCount', $this->allIncompleteTasks)
            ->with('completedTaskCount', $this->allCompletedTasks)
            ->with('components', $this->components);
    }
}
