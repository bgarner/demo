<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\District;
use App\Models\StoreApi\Region;

class DistrictAdminController extends Controller
{
    public function index()
    {
    	$districts = District::getAllDistricts();
        $regions = Region::all()->pluck('name', 'id')->prepend('Select one', '')->toArray();
    	return view('admin.district.index')->with('districts', $districts)
                                        ->with('regions', $regions);
    }

    public function store(Request $request)
    {
        District::createDistrict($request);
        return redirect()->action('StoreApi\DistrictAdminController@index');
    }

    public function edit($id)
    {
        $district = District::find($id);
        return view('admin.district.edit')->with('district', $district);

    }

    public function update($id, Request $request)
    {
        District::updateDistrict($id, $request);
        return redirect()->action('StoreApi\DistrictAdminController@index');
    }

    public function destroy($id)
    {
    	return District::deleteDistrict($id);
    }
}
