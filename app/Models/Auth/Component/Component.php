<?php

namespace App\Models\Auth\Component;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\RoleComponent;
use App\Models\Validation\ComponentValidator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use SoftDeletes;
    protected $table = 'components';
    protected $fillable = ['component_name', 'banner_id', 'deletable'];
    protected $dates = ['deleted_at'];

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

        $component = Component::create([
                'component_name' => $request['component_name'],
                'banner_id' => $request['banner_id'],
                'deletable' => 1

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

	public static function getComponentList()
    {
    	return Component::pluck('component_name', 'id');
    }
    

    public static function getComponentDetails()
    {
        return Component::all()
                        ->each(function($component){
                            $component->roles = RoleComponent::getRoleNameListByComponentId($component->id);
                });
    }

    public static function getComponentIdByComponentName($component_name)
    {
        return Component::where('component_name', $component_name)->first()->id;
    }

    public static function getComponentsToBeCreated()
    {
        $existingComponents = Component::all()->pluck('component_name', 'id')->toArray();
        foreach ($existingComponents as $key=>$component) {
            $existingComponents[$key] = preg_replace('/\s+/', '', $component);
        }

        $allComponents = array_unique(array_values(config('app.controllerComponentMap')));

        $partialsMap = [];
        foreach ($allComponents as $component) {
            $key = preg_replace('/\s+/', '', $component);
            $partialsMap[$key] = $component;
            
        }
        
        $newComponents = ['' => 'Select an option'];
        foreach ($partialsMap as $key=>$partial) {
            if(! in_array($key, $existingComponents)){
                $newComponents[$partial] = $partial;
            }
        }
        
        return $newComponents;
    }
}
