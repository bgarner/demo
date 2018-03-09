<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\Form;

class FormListAdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.form.formlist.index');
    }
}
