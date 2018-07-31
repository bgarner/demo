<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Region;
use App\Models\StoreApi\District;

class RegionAdminController extends Controller
{
    public function index()
    {
    	$regions = Region::getAllRegions();
        // $districts = District::all()->pluck('name', 'id')->toArray();
        return view('admin.region.index')->with('regions', $regions);
    }

    public function store(Request $request)
    {
        Region::createRegion($request);
        return redirect()->action('StoreApi\RegionAdminController@index');
    }

    public function edit($id)
    {
        $region = Region::find($id);
        return view('admin.region.edit')->with('region', $region);

    }

    public function update($id, Request $request)
    {
        Region::updateRegion($id, $request);
        return redirect()->action('StoreApi\RegionAdminController@index');
    }

    public function destroy($id)
    {
        return Region::deleteRegion($id);
    }
}
