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

    public static function getComponentListByRoleId($id)
    {
    	$components = RoleComponent::where('role_id', $id)->get()->pluck('component_id')->toArray();
    	return $components;
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

    public static function editRoleComponentPivotByRoleId($request, $id)
    {
        RoleComponent::where('role_id', $id)->delete();
        foreach ($request['components'] as $component_id) {
            RoleComponent::create([
                    'role_id' => $id,
                    'component_id'  => $component_id
                ]);
        }
    }
}
