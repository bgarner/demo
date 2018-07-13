<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\DistrictStore;

class DistrictStoreAdminController extends Controller
{
    public function update(Request $request, $store_number)
    {
    	return DistrictStore::updateDistrictStorePivot($store_number, $request->district_id);
    }
}
