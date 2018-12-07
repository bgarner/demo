<?php

namespace App\Http\Controllers\Form\InventoryAdjustment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;
use App\Models\Form\FormData;

class InventoryAdjustmentFormController extends Controller
{
    protected $formMeta;
    // protected $form_name;
    // protected $current_version;
    // protected $store_number;

    public function __construct()
    {
        $this->formMeta = [
            'name' => 'inventory_adjustment_form',
            'version' => '1.0',
            'store_number' => RequestFacade::segment(1),
            'model' => "\\App\\Models\\Form\\InventoryAdjustment\\InventoryAdjustmentForm"
        ];
    }

    public function index()
    {
        return 'list of previous submitted forms';
        // $forms = FormData::getFormData($this->formMeta);
        // return view('site.form.inventoryadjustmentform.index')
        //         ->with('forms', $forms);
    }

    public function show($storeNumber, $id, Request $request)
    {
        
        return 'view a request';
    }

    public function create()
    {
        $form_id = Form::getFormId($this->formMeta);
        return view('site.form.inventoryadjustmentform.create')
            ->with('storeNumber', $this->formMeta['store_number'])
            ->with('form_id', $form_id);
    }

    public function store(Request $request)
    {
        return 'store the form';
    }
}
