<?php

namespace App\Http\Controllers\StoreComponent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreComponent\StoreComponent;
use App\Models\Auth\User\UserSelectedBanner;

class StoreComponentAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components =  StoreComponent::getComponentDetailsByBanner();
        return view('admin.storecomponent.index')->with('store_components', $components);
                        
    }
    public function update(Request $request, $id)
    {
    	return StoreComponent::updateComponent($request,$id);
    	
    }
}
