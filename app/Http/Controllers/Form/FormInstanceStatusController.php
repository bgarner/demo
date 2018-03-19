<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormActivityLog;
use App\Models\Form\Status;
use Carbon\Carbon;

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
        \Log::info($request->all());

        $formActivityInstance = FormActivityLog::find($id);

        $log = unserialize($formActivityInstance->log);

        $log["answer_submitted_by"] = $request->submitted_by;
        $log["answer_submitted_by_position"] = $request->submitted_by_position;
        $log["answer"] = $request->answer;
        $log["answer_time"] = Carbon::now()->toDateTimeString();

        $formActivityInstance->allow_response = null;

        \Log::info($formActivityInstance);

        $formActivityInstance->log = serialize($log);
        $formActivityInstance->save();

    }


}
