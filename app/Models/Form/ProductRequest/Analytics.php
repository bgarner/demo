<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\FormData;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;
use App\Models\Form\FormInstanceUserMap;
use App\Models\Form\FormInstanceGroupMap;
use App\Models\Form\GroupUser;

class Analytics extends Model
{
    public static function getFormsForFormUser()
    {
    	$user = \Auth::user();
    	
    	$business_units = FormUserBusinessUnitMap::getBusinessUnitsByFormUserId($user->id);
    		
    	$forms = [];

    	if( $user->group_id = 3 && $user->role != 'Analyst' ){

	    	//for form admin and Bu admin
	    	foreach ($business_units as $business_unit_id => $business_unit) {
	    		$forms[$business_unit] = FormData::getFormInstancesByBusinessUnitId($business_unit_id);
	    	}
    	}

    	if( $user->group_id = 3 && $user->role == 'Analyst' ){

	    	$forms['userAssignments'] = FormInstanceUserMap::getFormInstancesByUserId($user->id);

	    	$user_groups = GroupUser::getGroupsByUserId($user->id);
	    	
	    	$forms['groupAssignments'] = FormInstanceGroupMap::getFormInstancesByGroupId($user_groups);
	    	
    	}


    	return ($forms);
    	

    }

    public static function getAnalyticsForFormUser()
    {
    	return ;
    }
}
