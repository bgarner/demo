<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\Form;

class FormListAdminController extends Controller
{
    
    public function index()
    {
        $user = \Auth::user();
        $forms = Form::getFormsByAdminId($user->id);
        return view('admin.form.formlist.index')->with('forms', $forms);
    }
}
