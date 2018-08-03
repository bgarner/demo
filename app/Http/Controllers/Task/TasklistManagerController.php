<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Task\Tasklist;

class TasklistManagerController extends Controller
{
    protected $user_id;
    protected $stores;
    protected $storeGroups;
    protected $banners;

    public function __construct()
    {
		
		
    }
    public function index(Request $request)
    {	

	    $this->user_id = \Auth::user()->id;
	    
    	$storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());

    	// return Event::getActiveEventsForStoreList($this->stores, $this->banners, $this->storeGroups);
    }
}
