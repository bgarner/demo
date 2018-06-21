<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\StoreApi\StoreInfo;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\Store;
use App\Models\Utility\Utility;

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
    protected $notifications;

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

        $this->notifications = Store::where('store_number', $this->storeNumber)->first()->unreadNotifications->each(function($item){
            $item->prettyCreatedAt = Utility::prettifyDateWithTime($item->created_at);
        });


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
            ->with('isComboStore', $this->isComboStore)
            ->with('notifications', $this->notifications);
    }
}