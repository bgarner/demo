<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\Form;
use App\Models\Form\FormData;
use App\Models\Utility\Utility;
use App\Models\Form\Status;

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
        $form_name = $this->form_name;
        $forms = FormData::where('form_name', $form_name)->get();
        return view('admin.form.storefeedbackform.index')
                ->with('forms', $forms);
   	}



    public function show($id, Request $request)
    {
        $formInstance = FormData::find($id);
        // $formName = $formInstance->form_name;
        // $formVersion = $formInstance->form_version;
        $formInstance->form_data = unserialize( $formInstance->form_data);
        $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
        $formInstance->sinceSubmitted = Utility::getTimePastSinceDate($formInstance->created_at);
        // $formStructure = $form->form_struct
        $formStructure = 'view';
        // dd($formInstance);
        $view = 'admin.form.storefeedbackform.' . $formStructure;
        return view($view)->with('formInstance', $formInstance);

    }
}
