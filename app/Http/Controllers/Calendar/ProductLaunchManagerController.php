<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\ProductLaunch\ProductLaunch;

class ProductLaunchManagerController extends Controller
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
    	$storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id);
        $stores = $storesByBanner->flatten()->toArray();
    	$productLaunches =  ProductLaunch::getActiveProductLaunchesForStoreList($stores);
        $lastUpdated ="";
        if ( count($productLaunches) > 0){
            $lastUpdated = ProductLaunch::getLastUpdatedTimestamp();
        }
        return view('manager.calendar.productlaunch.index')
            ->with('productLaunches', $productLaunches)
            ->with('lastUpdated',  $lastUpdated); 
    }
}
