<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class GroupComponent extends Model
{
    protected $table = 'group_component';
    protected $fillable = ['group_id', 'component_id'];

    public static function getGroupListByComponentId($id)
    {
    	$groups = GroupComponent::where('component_id', $id)->get()->pluck('group_id')->toArray();
    	return $groups;
    }

    public static function getGroupNameListByComponentId($id)
    {
    	$groups = GroupComponent::join('user_groups', 'user_groups.id', '=', 'group_component.group_id')
    							->where('component_id', $id)
    							->select( 'user_groups.id', 'user_groups.name')
    							->get();
    	return $groups;
    }


    public static function getComponentListByGroupId($id)
    {
    	$components = GroupComponent::where('group_id', $id)->get()->pluck('component_id')->toArray();
    	return $components;
    }

    public static function getComponentNameListByGroupId($id)
    {
    	$components = GroupComponent::join('components', 'components.id', '=', 'group_component.component_id')
    							->where('group_id', $id)
    							->select( 'components.id', 'components.component_name')
    							->get();
    	return $components;
    }

    public static function createComponentGroupPivotWithComponentId($component, $request)
    {
    	foreach ($request['groups'] as $group_id) {
    		GroupComponent::create([
    			'component_id' => $component->id,
    			'group_id' => $group_id

    		]);	
    	}
    	
    }
    public static function createComponentGroupPivotWithGroupId($group, $request)
    {
    	foreach ($request['components'] as $component_id) {
    		GroupComponent::create([
    			'group_id' => $group->id,
    			'component_id' => $component_id

    		]);	
    	}
    	
    }
    public static function editComponentGroupPivotByComponentId($request, $id)
    {
    	GroupComponent::where('component_id', $id)->delete();
    	foreach ($request['groups'] as $group_id) {
    		GroupComponent::create([
    				'component_id' => $id,
    				'group_id'	=> $group_id
    			]);
    	}
    }
    public static function editComponentGroupPivotByGroupId($request, $id)
    {
    	GroupComponent::where('group_id', $id)->delete();
    	foreach ($request['components'] as $component_id) {
    		GroupComponent::create([
    				'group_id' => $id,
    				'component_id'	=> $component_id
    			]);
    	}
    }

    public static function getAccessibleComponentNameList()
    {
        $group_id = \Auth::user()->group_id;
        return GroupComponent::getComponentNameArrayByGroupId($group_id);
    }

    public static function getComponentNameArrayByGroupId($group_id)
    {
        $components = GroupComponent::join('components', 'components.id', '=', 'group_component.component_id')
                                ->where('group_id', $group_id)
                                ->select('components.component_name')
                                ->get()
                                ->pluck('component_name')
                                ->toArray();
                                
        return $components;
    }
}
