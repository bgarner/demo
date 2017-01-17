<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\GroupComponent;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['component_name', 'banner_id'];

    public static function createComponent($request)
    {
    	$component = component::create([
                'component_name' => $request['component_name'],
                'banner_id' => $request['banner_id']

            ]);
    	GroupComponent::createComponentGroupPivotWithComponentId($component, $request);
    	return;

    }

    public static function editComponent($request, $id)
    {
    	$component = Component::find($id);
    	$component['component_name'] = $request['component_name'];
    	$component->save();
    	GroupComponent::editComponentGroupPivotBycomponentId($request, $id);
    	return $component;
    }

	public static function deleteComponent($id)
	{
		Component::find($id)->delete();
		GroupComponent::where('component_id', $id)->delete();
	}    

	public static function getComponentList($banner_id)
    {
    	return Component::where('banner_id', $banner_id)->get()->lists('component_name', 'id');
    }
    

    public static function getComponentDetails()
    {
        return Component::all()->each(function($component){
            $component->groups = GroupComponent::getGroupNameListBycomponentId($component->id);
        });
    }
}
