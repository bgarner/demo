<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupRole;
use App\Models\Auth\Role\RoleComponent;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['role_name'];

    public static function getRoleByUserId($user_id)
    {
    	return Role::join('user_role', 'user_role.role_id', '=', 'roles.id')
    		->where('user_id', $user_id)
    		->first()->role_name;
    }

    public static function getRoleDetails()
    {
    	return Role::all()->each(function($role){

            $role->groups = GroupRole::getGroupNameListByRoleId($role->id);
            $role->components = RoleComponent::getComponentsNameListByRoleId($role->id);

        });
    }

    public static function getRoleList()
    {
		return Role::all()->lists('role_name', 'id');    	
    }

   	public static function createRole($request)
    {
    	\Log::info($request->all());
    	$role = Role::create([
                'role_name' => $request['role_name']

            ]);
    	GroupRole::createRoleGroupPivotWithRoleId($role, $request);
    	RoleComponent::createRoleComponentPivotWithRoleId($role, $request);
    	return;

    }

    public static function editRole($request, $id)
    {
    	$role = Role::find($id);
    	$role['role_name'] = $request['role_name'];
    	$role->save();
    	GroupRole::editRoleGroupPivotByRoleId($request, $id);
        RoleComponent::editRoleComponentPivotByRoleId($request, $id);
    	return $role;
    }

    public static function deleteRole($id)
    {
    	GroupRole::where('role_id', $id)->delete();
    	RoleComponent::where('role_id', $id)->delete();
        Role::find($id)->delete();
    }
}
