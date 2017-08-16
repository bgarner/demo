<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserResource;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\Resource\ResourceTypes;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\Store;
use App\Models\StoreApi\Region;

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
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $storeInfoJson = file_get_contents( $storeAPI . "/banner/" . $banner_id . "/stores");
        $storeInfoJson = Banner::getStoreDetailsByBannerid($banner_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getStoreInfoByStoreId($store_id)
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $storeInfoJson = file_get_contents( $storeAPI . "/store/" . $store_id);
        $storeInfoJson = Store::getStoreDetailsByStoreNumber($store_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getAllStoreNumbers()
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $storeInfoJson = file_get_contents( $storeAPI . "/stores");
        $storeInfoJson = Store::getAllStores();
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
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $storeInfoJson = file_get_contents( $storeAPI . "/district/" . $id . "/stores");
        $storeInfoJson = Store::getStoreDetailsByDistrictId($id);
        $storeInfo = json_decode($storeInfoJson);
        $storeList = [];
        foreach ($storeInfo as $store) {
            array_push($storeList, $store->store_number);
        }
        return $storeList;
    }

    public static function getStoresByRegionGroupedByDistrict($id)
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $districtInfoJson = file_get_contents( $storeAPI . "/region/" . $id );
        $districtInfoJson = Region::getRegionDetailsByDistrictId($id);
        $districtInfo = json_decode($districtInfoJson);
        return $districtInfo;
    }

    public static function getStoresByRegionId($id)
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $districtInfoJson = file_get_contents( $storeAPI . "/region/" . $id . "/districts");
        $districtInfoJson = District::getDistrictDetailsByRegionId($id);
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

    public static function getStoreNamesList()
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $storeInfoJson = file_get_contents( $storeAPI . "/stores");
        $storeInfoJson = Store::getAllStores();
        $storeInfo = json_decode($storeInfoJson);
        $storeList = [];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_id] = $store->name;
        }
        return $storeList;   
    }

    public static function getDistrictNamesList()
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $districtInfoJson = file_get_contents( $storeAPI . "/districts");
        $districtInfoJson = District::getAllDistricts();
        $districtInfo = json_decode($districtInfoJson);
        $districtList = [];
        foreach ($districtInfo as $district) {
            $districtList[$district->id] = $district->name;
        }
        return $districtList;   
    }

    public static function getRegionNamesList()
    {
        // $storeAPI = env('STORE_API_DOMAIN', false);
        // $regionInfoJson = file_get_contents( $storeAPI . "/regions");
        $regionInfoJson = Region::getAllRegions();
        $regionInfo = json_decode($regionInfoJson);
        $regionList = [];
        foreach ($regionInfo as $region) {
            $regionList[$region->id] = $region->name;
        }
        return $regionList;   
    }

    public static function getStoreListingByManagerId($user_id)
    {
        $storeAPI = env('STORE_API_DOMAIN', false);
        $resource_id = UserResource::where('user_id', $user_id)->first()->resource_id;

        $resource = Resource::find($resource_id);
        $resource_type_name = ResourceTypes::find($resource->resource_type_id)->resource_name;


        switch ($resource_type_name) {
            case 'store':
                $storeInfo = [];
                array_push($storeInfo, Store::getStoreDetailsByStoreNumber($resource->resource_id) );
                $storeInfo = collect($storeInfo);
                break;

            case 'district':
                $storeInfo = Store::getStoreDetailsByDistrictId($resource->resource_id);
                break;
            
            case 'region':
                $storeInfo = Store::getStoreDetailsByRegionId($resource->resource_id);
                break;

            case 'regions':
                $storeInfo = Store::getAllStores();
                break;

            default:
                $storeInfo = [];
                break;
        }
        
        return json_decode($storeInfo);
    }

    

}
