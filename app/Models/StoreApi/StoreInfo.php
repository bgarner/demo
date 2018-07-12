<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserResource;
use App\Models\Auth\Role\RoleResource;
use App\Models\Auth\User\UserRole;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\Resource\ResourceTypes;

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
        $storeInfoJson = Banner::getStoreDetailsByBannerid($banner_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getStoreInfoByStoreId($store_id)
    {
        $storeInfoJson = Store::getStoreDetailsByStoreNumber($store_id);
        $storeInfo = json_decode($storeInfoJson);
        return $storeInfo;
    }

    public static function getAllStoreNumbers()
    {
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
        $districtInfoJson = Region::getRegionDetailsByDistrictId($id);
        $districtInfo = json_decode($districtInfoJson);
        return $districtInfo;
    }

    public static function getStoresByRegionId($id)
    {
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

        $userResource = UserResource::where('user_id', $user_id)->first();

        //user does not have an entry in user_resource_pivot
        if($userResource) {
            $resource = Resource::find($userResource->resource_id);
            $resource_type_name = ResourceTypes::find($resource->resource_type_id)->resource_name;    

        }
        else{
            $role_id = UserRole::where('user_id', $user_id)->first()->role_id;
            $resource_id = RoleResource::where('role_id', $role_id)->first()->resource_type_id;
            $resource_type_name = ResourceTypes::find($resource_id)->resource_name;    
        }

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
