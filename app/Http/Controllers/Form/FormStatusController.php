<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormActivityLog;

class FormStatusController extends Controller
{
    public function udpate(Request $request)
    {
    	$formStatus = FormInstanceStatusMap::create([
            "form_data_id" => $request->form_id,
            "status_code_id" =>$request->status
        ]);


    	$formLog =FormActivityLog::create([
            "form_data_id" => $request->form_id,
            "status_id" =>$request->status
        ]);
    }
}
