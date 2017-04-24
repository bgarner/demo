<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupRole;
use App\Models\Auth\Role\RoleComponent;
use App\Models\Auth\Role\RoleResource;
use App\Models\Validation\RoleValidator;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['role_name'];


    public static function validateCreateRole($request)
    {
        $validateThis = [
            'role_name' => $request['role_name']
            
        ];

        if(isset($request['groups']) && $request['groups']){
            $validateThis['groups'] = $request['groups'];
        }
        if(isset($request['components']) && $request['components']){
            $validateThis['components'] = $request['components'];
        }
        if(isset($request['resource_type']) && $request['resource_type']){
            $validateThis['resource_type'] = $request['resource_type'];
        }

        \Log::info($validateThis);
        $v = new RoleValidator();
          
        return $v->validate($validateThis);
    }

     public static function validateEditRole($request)
    {
        $validateThis = [
            'role_id'   => $request['id'],
            'role_name' => $request['role_name']
            
        ];

        if(isset($request['group']) && $request['group']){
            $validateThis['group'] = $request['group'];
        }
        if(isset($request['components']) && $request['components']){
            $validateThis['components'] = $request['components'];
        }
        if(isset($request['resource_type']) && $request['resource_type']){
            $validateThis['resource_type'] = $request['resource_type'];
        }

        \Log::info($validateThis);
        $v = new RoleValidator();
          
        return $v->validate($validateThis);
    }



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
		return Role::all()->pluck('role_name', 'id')->prepend('Select one', '');    	
    }

   	public static function createRole($request)
    {
        $validate = Self::validateCreateRole($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }

    	$role = Role::create([
                'role_name' => $request['role_name']

            ]);
    	if(isset($request->groups)){
            GroupRole::createRoleGroupPivotWithRoleId($role, $request);
        }
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
    	\Log::info($request->all());
        $validate = Self::validateEditRole($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }
        $role = Role::find($id);
        $role['role_name'] = $request['role_name'];
        $role->save();

        if(isset($request->groups)){
        	GroupRole::editRoleGroupPivotByRoleId($request, $id);
        }
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
