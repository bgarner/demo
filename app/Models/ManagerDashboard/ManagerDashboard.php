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
        
        $storesByBanner = StoreInfo::getStoreListingByManagerId($user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());


        $compiledData = [];
        $compiledData["urgentNotices"] = UrgentNotice::getActiveUrgentNoticesForStoreList($storesByBanner, $storeGroups); 

        return $compiledData;
    }
}
