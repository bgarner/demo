<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormActivityLog;
use App\Models\Form\FormInstanceResolutionMap;

class FormInstanceStatusController extends Controller
{
    public function create(Request $request)
    {
        
        $result = FormInstanceStatusMap::updateFormInstanceStatus($request->form_instance_id, $request->status_code_id);
        
        if(array_key_exists('validation_result', $result) && $result["validation_result"] == 'false'){
            return json_encode($result);
        }

        if(isset($request->resolution_code_id)){
            $formInstanceResolution = FormInstanceResolutionMap::updateFormInstanceResolution($request->form_instance_id, $request->resolution_code_id);    
        }
        
        $formActivityLog = FormActivityLog::createFormInstanceActivityLog($request);
        return $result;
        
    }

    public function update($id, Request $request)
    {
        
        $formActivityLog = FormActivityLog::updateFormInstanceActivityLog($id, $request);
        return;

    }


}
