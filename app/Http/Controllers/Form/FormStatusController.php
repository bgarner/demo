<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormStatusMap;
use App\Models\Form\FormActivityLog;

class FormStatusController extends Controller
{
    public function udpate(Request $request)
    {
    	$formStatus = FormStatusMap::create([
            "form_data_id" => $request->form_id,
            "status_id" =>$request->status
        ]);


    	$formLog =FormActivityLog::create([
            "form_data_id" => $request->form_id,
            "status_id" =>$request->status
        ]);
    }
}
