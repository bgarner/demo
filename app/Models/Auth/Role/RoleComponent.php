<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;

class RoleComponent extends Model
{
    protected $table = 'role_component';

    protected $fillable = ['role_id', 'component_id'];

    public static function getComponentsNameListByRoleId($id)
    {
    	$components = RoleComponent::join('components', 'role_component.component_id', '=', 'components.id' )
                            ->where('role_component.role_id', $id)
                            ->select('components.id', 'components.component_name')
                            ->get();
        return $components;
    }
    public static function getRoleNameListByComponentId($id)
    {
        $roles = RoleComponent::join('roles', 'role_component.role_id', '=', 'roles.id' )
                            ->where('role_component.component_id', $id)
                            ->select('roles.id', 'roles.role_name')
                            ->get();
        return $roles;
    }


    public static function getComponentListByRoleId($id)
    {
    	$components = RoleComponent::where('role_id', $id)->get()->pluck('component_id')->toArray();
    	return $components;
    }

    public static function getRoleListByComponentId($id)
    {
        $roles = RoleComponent::where('component_id', $id)->get()->pluck('role_id')->toArray();
        return $roles;
    }


    public static function createRoleComponentPivotWithRoleId($role, $request)
    {
        foreach ($request['components'] as $component_id) {
            RoleComponent::create([
                'role_id' => $role->id,
                'component_id' => $component_id

            ]); 
        }
        
    }

    public static function createRoleComponentPivotWithComponentId($component, $request)
    {
        if(isset($request['roles']) && $request['roles']){
            foreach ($request['roles'] as $role_id) {
                RoleComponent::create([
                    'component_id' => $component->id,
                    'role_id' => $role_id

                ]); 
            }
        }
        
    }

    public static function editRoleComponentPivotByRoleId($request, $id)
    {
        RoleComponent::where('role_id', $id)->delete();
        if(isset($request->components)){
            foreach ($request['components'] as $component_id) {
                RoleComponent::create([
                        'role_id' => $id,
                        'component_id'  => $component_id
                    ]);
            }
        }
    }

    public static function editRoleComponentPivotByComponentId($request, $id)
    {
        RoleComponent::where('component_id', $id)->delete();
        foreach ($request['roles'] as $role_id) {
            RoleComponent::create([
                    'role_id' => $role_id,
                    'component_id'  => $id
                ]);
        }
    }
    public static function getAccessibleComponentNameList()
    {
        $role = Role::getRoleByUserId(\Auth::user()->id);
        return RoleComponent::getRoleNameArrayByRoleId($role->role_id);
    }

    public static function getRoleNameArrayByRoleId($role_id)
    {
        $components = RoleComponent::join('components', 'components.id', '=', 'role_component.component_id')
                                ->where('role_id', $role_id)
                                ->select('components.component_name')
                                ->get()
                                ->pluck('component_name')
                                ->toArray();
                                
        return $components;
    }
}
