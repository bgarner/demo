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
    	
        $banners = array_map('strtoupper',  Banner::all()->pluck('banner_class', 'id')->toArray());

        $districts = District::getAllDistricts();
        $regions = Region::getAllRegions();
    	return view('admin.storestructure.index')->with('districts', $districts)
    											->with('regions', $regions)
    											->with('banners', $banners);
    }
    
}
