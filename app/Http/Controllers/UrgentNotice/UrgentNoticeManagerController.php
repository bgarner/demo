<?php

namespace App\Http\Controllers\UrgentNotice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\UrgentNotice\UrgentNotice;

class UrgentNoticeManagerController extends Controller
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
	    
    	$storeList = StoreInfo::getStoreListingByManagerId($this->user_id);
        $this->stores = array_column($storeList, 'store_number');
        $this->storeGroups = CustomStoreGroup::getStoreGroupsForManager($this->stores);

        $this->banners = UserBanner::getAllBanners()->pluck( 'id');

    	return UrgentNotice::getActiveUrgentNoticesForStoreList($this->stores, $this->banners, $this->storeGroups);
    } 
}
