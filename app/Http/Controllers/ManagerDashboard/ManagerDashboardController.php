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

        $user_id        = \Auth::user()->id;
        $storesByBanner = StoreInfo::getStoreListingByManagerId($user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }
        $stores         = $storesByBanner->flatten()->toArray();

        
        $storeGroups    = CustomStoreGroup::getStoreGroupsForManager($stores);

        $features       = Feature::getActiveFeatureForStoreList($storesByBanner, $storeGroups);
    	
        return view('manager.dashboard.index')->with('features', $features)->with('stores', $stores);

    }

    
}
