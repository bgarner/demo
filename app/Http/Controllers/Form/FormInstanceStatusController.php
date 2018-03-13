<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormActivityLog;
use App\Models\Form\Status;

class FormInstanceStatusController extends Controller
{
    public function update(Request $request)
    {
        $origin = $request->origin;
        $status = $request->status_code_id;
        $formInstanceId = $request->form_instance_id;
        $comment = $request->comment;

        switch($origin){
            case "admin":
                $user = \Auth::user();
                $userposition = \Auth::user()->fglposition;
                break;

            case "store":
                $user = $request->submitted_by;
                $userposition = $request->submitted_by_position;
                break;
        }
        

    	$formStatus = FormInstanceStatusMap::create([
            "form_data_id" => $formInstanceId,
            "status_code_id" => $status
        ]);

        $statusMeta = Status::find($status);
        
        $log = [
            "status_id" => $status,
            "status_admin_name" => $statusMeta->admin_status,
            "status_store_name" => $statusMeta->store_status,
            "status_icon" => $statusMeta->icon,
            "status_colour" => $statusMeta->colour,
            "status_admin_username" => $user->firstname . " " . $user->lastname,
            "status_store_username" => "",
            "comment" => $comment
        ]

    	$formLog =FormActivityLog::create([
            "form_data_id" => $formInstanceId,
            "log" => 
            "status_id" =>$request->status
        ]);
        

    }
}
