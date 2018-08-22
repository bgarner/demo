<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\RolePermission;
use App\Models\Form\Form;


class FormListManagerController extends Controller
{
    public function index()
    {

        $forms = Form::getFormsByAdminRoleId();
        return view('manager.form.formlist.index')->with('forms', $forms);
    }
    
}

