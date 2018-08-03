<?php

namespace App\Http\Controllers\StoreComponent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreComponent\StoreSubComponent;
use App\Models\Auth\User\UserSelectedBanner;

class SubComponentAdminController extends Controller
{
    public function update(Request $request, $id)
    {
    	return StoreSubComponent::updateComponent($request,$id);
    	
    }
}
