<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Form\FormData;
use App\Models\Form\Form;
use App\Models\Form\FormActivityLog;


class ProductRequestFormManagerController extends Controller
{
    public function __construct()
    {
    	$this->form_name = 'product_request_form';
    	$this->current_version = '1.0';
    	$this->form_id  = Form::where('form_name', $this->form_name)
		                        ->where('version', $this->current_version)
		                        ->first()
		                        ->id;
    }
    public function index()
    {
    	$this->user_id = \Auth::user()->id;

        $storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        $stores = $storesByBanner->flatten()->toArray();

        $forms = FormData::getAdminFormDataByFormIdAndStoreList($this->form_id, $stores);
        
        return view('manager.form.productrequestform.index')->with('forms', $forms);
    }

    public function show($id)
    {
    	$formInstance = FormData::getFormInstanceById($id);
        
        $log = FormActivityLog::getFormInstanceLog($id);
    
        $view = 'manager.form.productrequestform.view';
        return view($view)->with('formInstance', $formInstance)
                        ->with('log', $log);
    }
}
