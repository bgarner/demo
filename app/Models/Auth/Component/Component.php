<?php

namespace App\Models\Auth\Component;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\RoleComponent;
use App\Models\Validation\ComponentValidator;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['component_name', 'banner_id'];

    public static function validateComponent($request)
    {
        $validateThis = [
            'component_name' => $request['component_name']
        ];   

        if(isset($request['id']) && $request['id']){
            $validateThis['component_id'] = $request['id'];
        }
        if(isset($request['roles']) && $request['roles']){
            $validateThis['roles'] = $request['roles'];
        }
        \Log::info($validateThis);
        $v = new ComponentValidator();
          
        return $v->validate($validateThis);

    }

    public static function createComponent($request)
    {
        $validate = Self::validateComponent($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }

        $component = component::create([
                'component_name' => $request['component_name'],
                'banner_id' => $request['banner_id']

            ]);
    	RoleComponent::createRoleComponentPivotWithComponentId($component, $request);
    	return $component;

    }

    public static function editComponent($request, $id)
    {
    	$validate = Self::validateComponent($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }


        $component = Component::find($id);
    	$component['component_name'] = $request['component_name'];
    	$component->save();
    	RoleComponent::editRoleComponentPivotByComponentId($request, $id);
    	return $component;
    }

	public static function deleteComponent($id)
	{
		Component::find($id)->delete();
		RoleComponent::where('component_id', $id)->delete();
	}    

	public static function getComponentList($banner_id)
    {
    	return Component::where('banner_id', $banner_id)->get()->pluck('component_name', 'id');
    }
    

    public static function getComponentDetails()
    {
        return Component::all()->each(function($component){
            $component->roles = RoleComponent::getRoleNameListByComponentId($component->id);
        });
    }

    public static function getComponentIdByComponentName($component_name)
    {
        return Component::where('component_name', $component_name)->first()->id;
    }
}
