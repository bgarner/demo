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

class ManagerDashboard extends Model
{
    // public static function compileDashboardDataByDistrictId($id)
    // {
    // 	$stores = StoreInfo::getStoresByDistrictId($id);
    // 	return ManagerDashboard::compileDashboardDataByStoreList($stores);
    // }

    // public static function compileDashboardDataByRegionId($id)
    // {
    //     $stores = StoreInfo::getStoresByRegionId($id);
    //     return ManagerDashboard::compileDashboardDataByStoreList($stores);
    // }

    public static function compileDashboardDataForManager($user_id)
    {
        $storeList = StoreInfo::getStoreListingByManagerId($user_id);
        $stores = array_column($storeList, 'store_number');

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($user_id);

        $banners = UserBanner::getAllBanners()->pluck( 'id');



        $compiledData = [];
        $compiledData["communications"] = Communication::getActiveCommunicationsForStoreList($stores, $banners, $storeGroups);
        
        // $compiledData["alerts"] = Alert::getActiveAlertsForStoreList($stores);
        // $compiledData["urgentNotices"] = UrgentNotice::getActiveUrgentNoticesForStoreList($stores);
        // $compiledData["productLaunches"] = ProductLaunch::getActiveProductLaunchesForStoreList($stores);
        return ( $compiledData );
    }
}
