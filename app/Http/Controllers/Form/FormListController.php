<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Form\Form;

class FormListController extends Controller
{
    protected $store_number;

    public function __construct()
    {
        $this->store_number = RequestFacade::segment(1);
    }

    public function index()
    {
        $forms = Form::all();
        return view('site.form.formlist.index')
                ->with('store_number', $this->store_number)
                ->with('forms', $forms);

    }
}
