<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupRole;
use App\Models\Auth\Role\RoleComponent;
use App\Models\Auth\Role\RoleResource;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['role_name'];

    public static function getRoleByUserId($user_id)
    {
    	return Role::join('user_role', 'user_role.role_id', '=', 'roles.id')
    		->where('user_id', $user_id)
    		->first();
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
		return Role::all()->pluck('role_name', 'id');    	
    }

   	public static function createRole($request)
    {
    	\Log::info($request->all());
    	$role = Role::create([
                'role_name' => $request['role_name']

            ]);
    	GroupRole::createRoleGroupPivotWithRoleId($role, $request);
        if(isset($request->components)){
            RoleComponent::createRoleComponentPivotWithRoleId($role, $request);
        }
        if(isset($request->resource_type)){
            RoleResource::createRoleResourceTypePivotWithRoleId($role, $request);    
        }
        
    	return;

    }

    public static function editRole($request, $id)
    {
    	$role = Role::find($id);
    	$role['role_name'] = $request['role_name'];
    	$role->save();
    	GroupRole::editRoleGroupPivotByRoleId($request, $id);
        if(isset($request->components)){
            RoleComponent::editRoleComponentPivotByRoleId($request, $id);
        }
        if(isset($request->resource_type)){
            RoleResource::editRoleResourceTypePivotWithRoleId($role, $request);    
        }
    	return $role;
    }

    public static function deleteRole($id)
    {
    	GroupRole::where('role_id', $id)->delete();
    	RoleComponent::where('role_id', $id)->delete();
        Role::find($id)->delete();
    }
}
