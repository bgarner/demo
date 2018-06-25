<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;
use App\Models\Form\FormData;
use App\Models\Form\FormActivityLog;

class ProductRequestFormController extends Controller
{
    protected $formMeta;
    // protected $form_name;
    // protected $current_version;
    // protected $store_number;

    public function __construct()
    {
        $this->formMeta = [
            'name' => 'product_request_form',
            'version' => '1.0',
            'store_number' => RequestFacade::segment(1),
            'model' => "\\App\\Models\\Form\\ProductRequest\\ProductRequestForm"
        ];
    }

    public function index()
    {
        $forms = FormData::getFormData($this->formMeta);
        
        return view('site.form.productrequestform.index')
                ->with('forms', $forms);
    }

    public function show($storeNumber, $id, Request $request)
    {
        
        $formInstance = FormData::getFormInstanceById($id);
        
        $log = FormActivityLog::getFormInstanceLog($id);
    
        $view = 'site.form.productrequestform.view';
        return view($view)->with('formInstance', $formInstance)
                        ->with('storeNumber', $this->formMeta['store_number'])
                        ->with('log', $log);
    }

    public function create()
    {
   		$form_id = Form::getFormId($this->formMeta);
   		
        $formStructure = 'createOrUpdate';
   		$view = 'site.form.productrequestform.' . $formStructure;
    	return view($view)
            ->with('storeNumber', $this->formMeta['store_number'])
            ->with('form_id', $form_id);
    }

    public function store(Request $request)
    {
        $form = FormData::createNewFormInstance($request);
        return $form;
    }

}
