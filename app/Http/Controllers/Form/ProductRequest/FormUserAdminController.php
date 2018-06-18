<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormRoleMap;
use App\Models\Auth\User\UserRole;
use App\Models\Form\FormRoleHierarchy;


class FormUserAdminController extends Controller
{
    public function show($id)
    {
        
        // $employeeRoles = FormRoleHierarchy::getCurrentEmployeeRoleIds();
        $roles =  FormRoleMap::getRoleListByFormId($id);
        // $roles = array_intersect( $employeeRoles, $formRoles);
        $users = UserRole::getFormUsersByRoleList($roles);    
        return $users;
    }
}
