<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'form_role_permission';
    protected $fillable = ['role_id', 'permission_id'];

    public static function getPermissionsByRoleId($role_id)
    {
    	return RolePermission::join('form_permissions', 'form_role_permission.permission_id', '=', 'form_permissions.id')
									->where('role_id', $role_id)
									->select('form_permissions.*')
									->get();
    }
}
