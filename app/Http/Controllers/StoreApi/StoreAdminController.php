<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\Store;

class StoreAdminController extends Controller
{
    public function index()
    {
    	$banners = Banner::all();
    	$stores = Store::getAllStores();
    	
        return view('admin.store.index')->with('stores', $stores);
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
