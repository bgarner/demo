<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\UserSelectedBanner;

class StoreInfo extends Model
{
    
    public static function getStoresInfo($banner_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/banner/" . $banner_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getStoreListing($banner_id)
    {
    	
        $storeInfo = StoreInfo::getStoresInfo($banner_id);
        $storelist = StoreInfo::buildStoreList($storeInfo);
        return $storelist;
    }

    public static function buildStoreList($storeInfo)
    {
    	$storelist = [];
    	foreach ($storeInfo as $store) {
    			$storelist[$store->store_number] = $store->store_id . " " . $store->name;
    	}
    	return $storelist;	
    }


    public static function getComboStoreList($banner_id)
    {
        $storeInfo = StoreInfo::getStoresInfo($banner_id);
        $comboStoreList = [];
        foreach ($storeInfo as $store) {
            if($store->is_combo_store == 1) {
                $comboStoreList[$store->store_id] = $store->store_number;
            }
        }

        return $comboStoreList;
    }

    public static function getStoreListingForStoreNumberOffset($banner_id)
    {
        $storeInfo = StoreInfo::getStoresInfo($banner_id);
        $storeList = [];
        foreach ($storeInfo as $store) {
            
            $storeList[$store->store_id] = $store->store_number;
            
        }
        return $storeList;
    }

    public static function getStoreInfoByStoreId($store_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/store/" . $store_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }
}
