<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\District;

class DistrictAdminController extends Controller
{
    public function index()
    {
    	$districts = District::getAllDistricts();
    	return view('admin.district.index')->with('districts', $districts);
    }
}
