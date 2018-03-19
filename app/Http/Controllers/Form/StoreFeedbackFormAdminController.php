<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormData;
use App\Models\Form\FormStatusMap;
use App\Models\Form\FormActivityLog;

class StoreFeedbackFormAdminController extends Controller
{
    protected $form_name;
    protected $current_version;
    protected $unique_form_id;

    public function __construct()
    {
    	$this->form_name = 'store_feedback_form';
    	$this->current_version = '1.0';
    }

    public function index()
    {
        
        $forms = FormData::getAdminFormDataByFormNameAndVersion($this->form_name, $this->current_version);
        return view('admin.form.storefeedbackform.index')
                ->with('forms', $forms);
   	}



    public function show($id, Request $request)
    {
        
        $formInstance = FormData::getFormInstanceById($id);
        $log = FormActivityLog::getFormInstanceLog($id);
        $codes = FormStatusMap::getStatusCodesByForm($formInstance->form_id);
        
        $formStructure = 'view';
        
        $view = 'admin.form.storefeedbackform.' . $formStructure;
        return view($view)
            ->with('log', $log)
            ->with('formInstance', $formInstance)
            ->with('codes', $codes);

    }
}
