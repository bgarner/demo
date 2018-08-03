<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\RegionDistrict;

class RegionDistrictAdminController extends Controller
{
    public function update(Request $request, $district_id)
    {
    	return RegionDistrict::updateRegionDistrictPivot($district_id, $request->region_id);
    }
}
