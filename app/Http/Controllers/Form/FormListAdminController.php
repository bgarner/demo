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
        $user = \Auth::user();
        $role_id = UserRole::where('user_id', $user->id)->first()->role_id;
        $permissions = RolePermission::getPermissionsByRoleId($role_id);
		
        $forms = Form::getFormsByAdminId($user->id);
        return view('admin.form.formlist.index')->with('forms', $forms);
    }
}
