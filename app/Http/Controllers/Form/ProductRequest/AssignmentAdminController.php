<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceUserMap;
use App\Models\Form\FormInstanceGroupMap;
use App\Models\Form\GroupUser;
use App\Models\Form\FormStatusMap;

class AssignmentAdminController extends Controller
{
    
    public function index()
    {

        $assignments['My Assignments'] = FormInstanceUserMap::getFormInstancesByUserId(\Auth::user()->id);

        $user_groups = GroupUser::getGroupsByUserId(\Auth::user()->id);
        
        $assignments['My Group Assignments'] = FormInstanceGroupMap::getFormInstancesByGroupId($user_groups);
        $role = preg_replace("/\s+/", "", \Auth::user()->role);
        $codes = FormStatusMap::getStatusCodesByForm(1);

        return view('formuser.'.$role.'.assignments.index')
                    ->with('assignments', $assignments)
                    ->with('codes', $codes);
        

    }


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
