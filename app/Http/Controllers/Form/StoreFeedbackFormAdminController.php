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
    	return view('admin.forms.storefeedbackform.index')->with('forms', $forms)
    												->with('formStructures', $formStructures);
   }

   public function create()
   {

   		$formStructure = Form::where('form_name', $this->form_name)
    							->where('version', $this->current_version)
    							->first()
    							->pluck('form_structure');

    	//render formStructure.json
   }

    public function show($id)
    {
    	$formInstanceId = $id;
    	$formData = FormData::find($id);
    	$form_name = $formData->form_name;
    	$form_version = $formData->form_version;
    	$form = Form::where('form_name', $form_name)
    							->where('form_version', $form_version)
    							->first();
    	$formStructure = $form->form_structure;

    	//render form_structure.json and pass it the form data
    }
}
