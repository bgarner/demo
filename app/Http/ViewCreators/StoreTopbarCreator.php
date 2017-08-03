<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\StoreInfo;
use App\Models\Banner;

class StoreTopbarCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $storeNumber;
    protected $banner;
    protected $isComboStore;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);

        $this->banner = Banner::find($storeInfo->banner_id);

        $this->isComboStore = $storeInfo->is_combo_store;

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        
        $view->with('banner', $this->banner)
            ->with('isComboStore', $this->isComboStore);
    }
}