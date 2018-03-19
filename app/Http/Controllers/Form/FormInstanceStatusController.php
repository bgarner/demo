<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormActivityLog;

class FormInstanceStatusController extends Controller
{
    public function create(Request $request)
    {
        
        $formStatus = FormInstanceStatusMap::updateFormInstanceStatus($request);
        $formActivityLog = FormActivityLog::createFormInstanceActivityLog($request);

        return "";
    }

    public function update($id, Request $request)
    {
        
        $formActivityLog = FormActivityLog::updateFormInstanceActivityLog($id, $request);
        return;

    }


}
