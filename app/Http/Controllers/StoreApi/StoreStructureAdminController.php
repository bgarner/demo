<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\Store;
use App\Models\StoreApi\District;
use App\Models\StoreApi\Region;

class StoreStructureAdminController extends Controller
{
    public function index()
    {
    	$banners = Banner::all();
    	$storeInfo = Store::getAllStores();
    	$stores = [];
        foreach ($storeInfo as $store) {
                $stores[$store->store_number] = strtoupper($banners->find($store->banner_id)->banner_class) . ' #' . $store->store_id . " " . $store->name;
        }
        uksort($stores, function($a, $b) {
           if (is_numeric($a) && is_numeric($b)) return $a - $b;
           else if (is_numeric($a)) return -1;
           else if (is_numeric($b)) return 1;
           return strcmp($a, $b);
        });



        $districts = District::getAllDistricts();
        $regions = Region::getAllRegions();
    	return view('admin.storestructure.index')->with('stores', $stores)
    											->with('districts', $districts)
    											->with('regions', $regions);
    }
    
}
