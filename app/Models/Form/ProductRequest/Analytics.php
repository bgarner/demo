<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\FormData;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;
use App\Models\Form\FormInstanceUserMap;
use App\Models\Form\FormInstanceGroupMap;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\GroupUser;
use Carbon\Carbon;
use App\Models\Utility\Utility;

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
        $user = \Auth::user();

        if( $user->group_id = 3 && $user->role == 'Product Request Form Admin' ){

            return Self::getAnalyticsForFormAdmin();
            
        }
        if( $user->group_id = 3 && $user->role == 'Product Request Business Unit Admin' ){

            $business_unit_id = FormUserBusinessUnitMap::where('user_id', \Auth::user()->id)
                                                ->first()
                                                ->business_unit_id;

            return Self::getAnalyticsForFormBUAdmin($business_unit_id);
        }        


    }

    public static function getAnalyticsForFormAdmin()
    {
    	
        $startDate =  Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        // Total new forms in last 7 days
        $analytics["totalNewFormsInLastWeek"] = FormInstanceStatusMap::where('status_code_id', '1')->where('created_at', '>=', $startDate)->get()->count();

        // Total in progress forms
        $analytics["totalInProgressForms"] = FormInstanceStatusMap::whereNotIn('status_code_id', ['1', '5'])->get()->count();    	    

    	//total closed in last 7 days
        $analytics["closedLastWeek"] = FormInstanceStatusMap::where('status_code_id', '5')->where('updated_at', '>=', $startDate)->get();

        //total time to close
        $time = 0;
        foreach ($analytics["closedLastWeek"] as $clw) {

            $closedAt = Carbon::createFromFormat('Y-m-d H:i:s', $clw->updated_at);
            $openedAt = Carbon::createFromFormat('Y-m-d H:i:s', $clw->created_at);
            $time += $openedAt->diffInMinutes($closedAt);
            
        }

        // Total closed forms in last 7 days
        $analytics["totalClosedFormsInLastWeek"] = count($analytics["closedLastWeek"]);


        $analytics["avgTimeToCloseTicketLastWeek"] = round(($time/$analytics["totalClosedFormsInLastWeek"])/60, 2);

        $analytics["start"] = Utility::prettifyDate($startDate->toDateTimeString());
        $analytics["end"] = Utility::prettifyDate($endDate->toDateTimeString());

        return $analytics;

    }

    public static function getAnalyticsForFormBUAdmin($business_unit_id)
    {
        
        $startDate =  Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        // Total new forms in last 7 days
        $analytics["totalNewFormsInLastWeek"] = FormInstanceStatusMap::join('form_data', 'form_data.id', '=', 'form_instance_status.form_data_id')
                                ->where('status_code_id', '1')
                                ->where('form_instance_status.created_at', '>=', $startDate)
                                ->where('form_data.business_unit_id', $business_unit_id)
                                ->select('form_instance_status.*')
                                ->get()
                                ->count();

        // Total in progress forms
        $analytics["totalInProgressForms"] = FormInstanceStatusMap::join('form_data', 'form_data.id', '=', 'form_instance_status.form_data_id')
                                ->whereNotIn('status_code_id', ['1', '5'])
                                ->where('form_data.business_unit_id', $business_unit_id)
                                ->select('form_instance_status.*')
                                ->get()
                                ->count();           

        //total closed in last 7 days
        $analytics["closedLastWeek"] = FormInstanceStatusMap::join('form_data', 'form_data.id', '=', 'form_instance_status.form_data_id')
                                ->where('status_code_id', '5')
                                ->where('form_instance_status.updated_at', '>=', $startDate)
                                ->where('form_data.business_unit_id', $business_unit_id)
                                ->select('form_instance_status.*')
                                ->get();

        //total time to close
        $time = 0;
        foreach ($analytics["closedLastWeek"] as $clw) {

            $closedAt = Carbon::createFromFormat('Y-m-d H:i:s', $clw->updated_at);
            $openedAt = Carbon::createFromFormat('Y-m-d H:i:s', $clw->created_at);

            $time += $openedAt->diffInMinutes($closedAt);
            
        }

        // Total closed forms in last 7 days
        $analytics["totalClosedFormsInLastWeek"] = count($analytics["closedLastWeek"]);


        $analytics["avgTimeToCloseTicketLastWeek"] = "-";
        if($analytics["totalClosedFormsInLastWeek"] > 0){
            $analytics["avgTimeToCloseTicketLastWeek"] = round(($time/$analytics["totalClosedFormsInLastWeek"])/60, 2);    
        }
        

        $analytics["start"] = Utility::prettifyDate($startDate->toDateTimeString());
        $analytics["end"] = Utility::prettifyDate($endDate->toDateTimeString());

        return $analytics;

    }
}
