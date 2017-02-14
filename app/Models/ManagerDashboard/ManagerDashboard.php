<?php

namespace App\Models\ManagerDashboard;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreInfo;
use App\Models\Communication\Communication;
use App\Models\Alert\Alert;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\ProductLaunch\ProductLaunch;

class ManagerDashboard extends Model
{
    public static function compileDashboardDataByDistrictId($id)
    {
    	$stores = StoreInfo::getStoresByDistrictId($id);
    	return ManagerDashboard::compileDashboardDataByStoreList($stores);
    }

    public static function compileDashboardDataByRegionId($id)
    {
        $stores = StoreInfo::getStoresByRegionId($id);
        return ManagerDashboard::compileDashboardDataByStoreList($stores);
    }

    public static function compileDashboardDataByStoreList($stores)
    {
        $compiledData = [];
        $compiledData["communications"] = Communication::getActiveCommunicationsForStoreList($stores);
        $compiledData["alerts"] = Alert::getActiveAlertsForStoreList($stores);
        $compiledData["urgentNotices"] = UrgentNotice::getActiveUrgentNoticesForStoreList($stores);
        $compiledData["productLaunches"] = ProductLaunch::getActiveProductLaunchesForStoreList($stores);
        return $compiledData;
    }
}
