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
    	$compiledData = [];
    	$communications = [];
    	$alerts = [];
    	$urgentNotices = [];
    	$productLaunches = [];

    	foreach ($stores as $store) {
    		
    		$communicationsByStore = CommunicationTarget::getTargetedCommunications($store->store_number);
    		$communications                                              	
    	}
    	
    }
}
