<?php

namespace App\Models\ManagerDashboard;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\StoreInfo;
use App\Models\Communication\Communication;
use App\Models\Alert\Alert;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Event\Event;

class ManagerDashboard extends Model
{
    
    public static function compileDashboardDataForManager($user_id)
    {
        $storeList = StoreInfo::getStoreListingByManagerId($user_id);
        $stores = array_column($storeList, 'store_number');

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($user_id);

        $banners = UserBanner::getAllBanners()->pluck( 'id');



        $compiledData = [];
        $compiledData["communications"] = Communication::getActiveCommunicationsForStoreList($stores, $banners, $storeGroups);
        
        $compiledData["alerts"] = Alert::getActiveAlertsForStoreList($stores, $banners, $storeGroups);
        $compiledData["urgentNotices"] = UrgentNotice::getActiveUrgentNoticesForStoreList($stores, $banners, $storeGroups); 
        $compiledData["productLaunches"] = ProductLaunch::getActiveProductLaunchesForStoreList($stores);

        $compiledData['calendar'] = Event::getActiveEventsForStoreList($stores, $banners, $storeGroups);

        return ( $compiledData );
    }
}
