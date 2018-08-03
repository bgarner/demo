<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Store;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\District;
use App\Models\Utility\Utility;

class StoreAdminController extends Controller
{
    public function index()
    {
    	$stores = Store::getAllStores();
        $banners = Banner::all()->pluck('name', 'id')->prepend('Select one', '')->toArray();
        $districts = District::all()->pluck('name', 'id')->prepend('Select one', '')->toArray();
        $provinces = Utility::getAllProvinces();
        return view('admin.store.index')->with('stores', $stores)
                                        ->with('banners', $banners)
                                        ->with('districts', $districts)
                                        ->with('provinces', $provinces);
    }

    public function create()
    {
        // return view('admin.store.create');        
    }


    public function store(Request $request)
    {
        \Log::info($request->all());
        Store::createNewStore($request);
        return redirect()->action('StoreApi\StoreAdminController@index');
    }

    public function edit($id)
    {
        $store = Store::find($id);
        $banners = Banner::all()->pluck('name', 'id')->prepend('Select one', '')->toArray();
        $provinces = Utility::getAllProvinces();
        return view('admin.store.edit')->with('store', $store)
                    ->with('banners', $banners)
                    ->with('provinces', $provinces);
    }

    public function update($id, Request $request)
    {
        Store::updateStore($id, $request);
        return redirect()->action('StoreApi\StoreAdminController@index');
    }

    public function destroy($id)
    {
    	return Store::deleteStore($id);
    }
}
