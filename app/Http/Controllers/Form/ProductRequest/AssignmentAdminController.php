<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceUserMap;
use App\Models\Form\FormInstanceGroupMap;

class AssignmentAdminController extends Controller
{
    public function update($form_instance_id, Request $request)
    {
    	
    	if(isset($request->user_id) ){
    		FormInstanceUserMap::updateFormAssignment($form_instance_id, $request->user_id);
    	}
    	if(isset($request->group_id) ){
    		FormInstanceGroupMap::updateFormAssignment($form_instance_id, $request->group_id);
    	}
    }
}
