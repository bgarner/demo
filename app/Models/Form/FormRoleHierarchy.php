<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\Role;

class FormRoleHierarchy extends Model
{
    protected $table = 'form_role_hierarchy';
    protected $fillable = ['manager_role_id', 'employee_role_id'];

    public static function getCurrentEmployeeRoleIds()
    {
    	$currentUserRole = \Auth::user()->role_id;
    	return FormRoleHierarchy::where('manager_role_id', $currentUserRole)->pluck('employee_role_id')->toArray();
    }

    public static function getCurrentEmployeeRoles()
    {
    	$ids = Self::getCurrentEmployeeRoleIds();
    	$roles = Role::whereIn('id', $ids)->get()->pluck('role_name', 'id')->prepend('Select one', '')->toArray();
    	return ($roles);
    }

    public static function getAllAccessibleRoles()
    {
        $employeeRoleIds = FormRoleHierarchy::getCurrentEmployeeRoleIds();

        $accessibleRoles = array_prepend( $employeeRoleIds , \Auth::user()->role_id);

        return $accessibleRoles;
    }
}
