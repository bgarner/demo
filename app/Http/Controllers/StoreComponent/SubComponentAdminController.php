<?php

namespace App\Http\Controllers\StoreComponent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreComponent\StoreSubComponent;
use App\Models\Auth\User\UserSelectedBanner;

class SubComponentAdminController extends Controller
{
    public function index()
    {
        $components =  StoreSubComponent::getComponentDetailsByBanner();
        return view('admin.storecomponent.index')->with('store_components', $components);
                        
    }
    public function update(Request $request, $id)
    {
    	return StoreSubComponent::updateComponent($request,$id);
    	
    }
}
