<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;
use App\Models\Form\FormData;

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
        $form_name = $this->form_name;
        $formStructures = Form::where('form_name', $form_name)->get();
        $forms = FormData::where('form_name', $form_name)->get();
        return view('site.form.storefeedbackform.index')->with('forms', $forms)
                                                    ->with('formStructures', $formStructures);
    }

    public function create()
    {
   		// $formStructure = Form::where('form_name', $this->form_name)
    	// 						->where('version', $this->current_version)
    	// 						->first()
    	// 						->pluck('form_structure');

   		$formStructure = 'createOrUpdate';
   		$view = 'site.form.storefeedbackform.' . $formStructure;
        \Log::info($this->store_number);
    	return view($view)->with('storeNumber', $this->store_number);
    }

    public function store(Request $request)
    {
        $form =FormData::create([
            "store_number" =>$request->storeNumber,
            "form_name" => $this->form_name,
            "form_version" => $this->current_version,
            "submitted_by" => "this person",
            "form_data" => serialize($request->all())
        ]);

        return $form;
    }

    public function edit($storeNumber, $id, Request $request)
    {
        $formInstanceId = $id;
        $formInstance = FormData::find($formInstanceId);
        $formName = $formInstance->form_name;
        $formVersion = $formInstance->form_version;
        $formInstance->form_data = json_encode(unserialize( $formInstance->form_data));

        // dd($formInstance);

        $form = Form::where('form_name', $formName)
                    ->where('version', $formVersion)
                    ->first();

        // $formStructure = $form->form_structure;

        $formStructure = 'createOrUpdate';

        $view = 'site.form.storefeedbackform.' . $formStructure;
        return view($view)->with('formInstance', $formInstance)
                        ->with('storeNumber', $this->store_number);
    }

    public function update($storeNumber, $id, Request $request)
    {
        return $request->all();
    }
}
