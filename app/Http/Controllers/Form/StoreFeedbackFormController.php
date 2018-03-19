<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;
use App\Models\Form\FormData;
use App\Models\Form\FormActivityLog;

class StoreFeedbackFormController extends Controller
{
    protected $form_name;
    protected $current_version;
    protected $store_number;

    public function __construct()
    {
        $this->form_name = 'store_feedback_form';
        $this->current_version = '1.0';
        $this->store_number = RequestFacade::segment(1);
    }

    public function index()
    {
        $forms = FormData::getAdminFormDataByFormNameAndVersionAndStore($this->form_name, $this->current_version, $this->store_number);
        
        return view('site.form.storefeedbackform.index')
                ->with('forms', $forms);
    }

    public function show($storeNumber, $id, Request $request)
    {
        
        $formInstance = FormData::getFormInstanceById($id);
        
        $log = FormActivityLog::getFormInstanceLog($id);
    
        $view = 'site.form.storefeedbackform.view';
        return view($view)->with('formInstance', $formInstance)
                        ->with('storeNumber', $this->store_number)
                        ->with('log', $log);
    }

    public function create()
    {
   		$form_id = Form::getFormIdByFormNameAndVersion($this->form_name, $this->current_version);
   		
        $formStructure = 'createOrUpdate';
   		$view = 'site.form.storefeedbackform.' . $formStructure;
    	return view($view)
            ->with('storeNumber', $this->store_number)
            ->with('form_id', $form_id);
    }

    public function store(Request $request)
    {
        $form = FormData::createNewFormInstance($request);
        return $form;
    }

}
