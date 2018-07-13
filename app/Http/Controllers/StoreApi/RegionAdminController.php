<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Region;

class RegionAdminController extends Controller
{
    public function index()
    {
    	$regions = Region::getAllRegions();
        return view('admin.region.index')->with('regions', $regions);
    }

    public function create()
    {

    }


    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
    	
    }
}
