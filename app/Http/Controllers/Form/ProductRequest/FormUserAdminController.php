<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormRoleMap;
use App\Models\Auth\User\UserRole;
use App\Models\Utility\Utility;

class FormUserAdminController extends Controller
{
    public function show($id)
    {
        $roles =  FormRoleMap::getRoleListByFormId($id);
        $users = UserRole::getFormUsersByRoleList($roles);    
        return $users;
    }
}
