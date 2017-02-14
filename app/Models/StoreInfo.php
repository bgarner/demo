<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\UserSelectedBanner;

class StoreInfo extends Model
{
    
    public static function getStoreListing($banner_id)
    {
    	
        $storeInfo = StoreInfo::getStoresInfo($banner_id);
        $storelist = StoreInfo::buildStoreList($storeInfo);
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


    public static function getStoresInfo($banner_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/banner/" . $banner_id . "/stores");
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getStoreInfoByStoreId($store_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/store/" . $store_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getAllStoreNumbers()
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/stores");
        $storeInfo = json_decode($storeInfoJson);
        $storelist = [];
        foreach ($storeInfo as $store) {
                $storelist[$store->store_number] = $store->store_id;
        }
        uksort($storelist, function($a, $b) {
           if (is_numeric($a) && is_numeric($b)) return $a - $b;
           else if (is_numeric($a)) return -1;
           else if (is_numeric($b)) return 1;
           return strcmp($a, $b);
        });
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

    public static function getStoresByDistrictId($id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $storeInfoJson = file_get_contents( $storeAPI . "/district/" . $id . "/stores");
        $storeInfo = json_decode($storeInfoJson);
        $storeList = [];
        foreach ($storeInfo as $store) {
            array_push($storeList, $store->store_number);
        }
        return $storeList;
    }

    public static function getStoresByRegionId($id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $districtInfoJson = file_get_contents( $storeAPI . "/region/" . $id . "/districts");
        $districtInfo = json_decode($districtInfoJson);
        $storeList = [];
        foreach ($districtInfo as $district) {
            $stores = $district->stores;
            foreach($stores as $store){
                array_push($storeList, $store->store_number);    
            }            
        }
        return $storeList;
    }
}
