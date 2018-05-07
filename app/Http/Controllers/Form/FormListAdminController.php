<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\Form;
use App\Models\Form\RolePermission;
use App\Models\Auth\User\UserRole;

class FormListAdminController extends Controller
{
    
    public function index()
    {

        $permissions = RolePermission::getPermissionsByRoleId();
        $forms = Form::getFormsByAdminRoleId();
        return view('admin.form.formlist.index')->with('forms', $forms);
    }
}
