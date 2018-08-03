<?php

namespace App\Http\Controllers\Alert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Alert\Alert;
use App\Models\Alert\AlertType;

class AlertManagerController extends Controller
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

        //$allAlerts are active or active+archived alerts for storelist
        $allAlerts = Alert::getAlertsForStoreList($storesByBanner, $request);   
        
        // filter alerts if type is set
        $alerts = Alert::filterAllAlertsByCategory($allAlerts, $request);
        
        $alertTypes = AlertType::getAlertTypesByStorelist($allAlerts);

        $alertCount = count($allAlerts);

        $title = AlertType::getAlertCategoryName($request['type']);

        return view('manager.alerts.index')
            ->with('alerts', $alerts)
            ->with('alertTypes', $alertTypes)
            ->with('alertCount', $alertCount)
            ->with('title', $title)
            ->with('archives', $request['archives']);
    }
}
