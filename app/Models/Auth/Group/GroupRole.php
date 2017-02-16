<?php

namespace App\Models\Auth\Group;

use Illuminate\Database\Eloquent\Model;

class GroupRole extends Model
{
    protected $table = 'group_role';

    protected $fillable = ['group_id', 'role_id'];

    public static function getRolesByGroupId($id)
    {
    	$roles = GroupRole::join('roles', 'group_role.role_id', '=', 'roles.id' )
    						->where('group_role.group_id', $id)
    						->select('roles.id', 'roles.role_name')
    						->get();
    	return $roles;
    }
}
