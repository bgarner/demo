<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\Form;
use App\Models\Form\FormData;

class StoreFeedbackFormAdminController extends Controller
{
    protected $form_name;
    protected $current_version;
    protected $unique_form_id;

    public function __construct()
    {

    	$this->form_name = 'store_feedback_form';
    	$this->current_version = '1.0';
    	$this->unique_form_id = $this->form_name . "_" . $this->current_version;

    }

    public function index()
    {
    	$form_name = $this->form_name;
    	$formStructures = Form::where('form_name', $form_name)->get();
    	$forms = FormData::where('unique_form_id', 'like',  $form_name . "_%")->get();
    	return view('admin.form.storefeedbackform.index')->with('forms', $forms)
    												->with('formStructures', $formStructures);
   	
   	}

   

    public function show($id)
    {
    	$formData = [];
    	// $formInstanceId = $id;
    	// $formInstance = FormData::find($formInstanceId);
    	// $formData =$formInstance->form_data;
    	// $formName = $formInstance->form_name;
    	// $formVersion = $formInstance->form_version;
    	
    	// $form = Form::where('form_name', $formName)
					// ->where('form_version', $formVersion)
					// ->first();

    	// $formStructure = $form->form_structure;

    	$formStructure = 'view';

    	$view = 'admin.form.storefeedbackform.' . $formStructure;
    	return view($view)->with('formdata', $formData);
    												
    }
}
