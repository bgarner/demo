<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;
use App\Models\Form\FormData;
use App\Models\Form\FormActivityLog;
use App\Models\Utility\Utility;

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
        $forms = FormData::where('form_name', $this->form_name)
                    ->where('store_number', $this->store_number)
                    ->get();
        return view('site.form.storefeedbackform.index')
                ->with('forms', $forms);
    }

    public function show($storeNumber, $id, Request $request)
    {
        $formInstanceId = $id;
        $formInstance = FormData::find($formInstanceId);
        $formName = $formInstance->form_name;
        $formVersion = $formInstance->form_version;
        $formInstance->form_data = unserialize( $formInstance->form_data);
        $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
        $formInstance->sinceSubmitted = Utility::getTimePastSinceDate($formInstance->created_at);
        
        $log = FormActivityLog::getFormInstanceLog($id);
    
        $view = 'site.form.storefeedbackform.view';
        return view($view)->with('formInstance', $formInstance)
                        ->with('storeNumber', $this->store_number)
                        ->with('log', $log);
    }

    public function create()
    {
   		$form_id = Form::where('form_name', $this->form_name)
    							->where('version', $this->current_version)
    							->first()
    							->id;

   		$formStructure = 'createOrUpdate';
   		$view = 'site.form.storefeedbackform.' . $formStructure;
        \Log::info($this->store_number);
    	return view($view)
            ->with('storeNumber', $this->store_number)
            ->with('form_id', $form_id);
    }

    public function store(Request $request)
    {
        $form =FormData::create([
            "form_id" => $request->form_id,
            "store_number" =>$request->storeNumber,
            "form_name" => $this->form_name,
            "form_version" => $this->current_version,
            "submitted_by" => $request->submitted_by,
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
