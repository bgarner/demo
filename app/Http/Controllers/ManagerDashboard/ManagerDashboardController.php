<?php

namespace App\Http\Controllers\ManagerDashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Feature\Feature;


class ManagerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	$user_id = \Auth::user()->id;
        $storeList = StoreInfo::getStoreListingByManagerId($user_id);
        $stores = array_column($storeList, 'store_number');
        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($stores);
        $banners = UserBanner::getAllBanners()->pluck( 'id');

    	$features = Feature::getActiveFeatureForStoreList($stores, $banners, $storeGroups);
    	
        return view('manager.dashboard.index')->with('features', $features)->with('stores', $stores);

    }

    
}
