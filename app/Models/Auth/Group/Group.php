<?php

namespace App\Models\Auth\Group;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupComponent;

class Group extends Model
{
    protected $table = 'user_groups';
    protected $fillable = ['name'];

    public static function createGroup($request)
    {
    	$group = Group::create([
                'name' => $request['group_name']
                // 'banner_id' => $request['banner_id']

            ]);
    	GroupComponent::createComponentGroupPivotWithGroupId($group, $request);
    	return;

    }

    public static function editGroup($request, $id)
    {
    	$group = Group::find($id);
    	$group['name'] = $request['group_name'];
    	$group->save();
    	GroupComponent::editComponentGroupPivotByGroupId($request, $id);
    	return $group;
    }

	public static function deleteGroup($id)
	{
		Group::find($id)->delete();
		GroupComponent::where('group_id', $id)->delete();
	}    

    public static function getGroupList($banner_id)
    {
    	return Group::all()->lists('name', 'id');
    }

    public static function getGroupDetails()
    {
        return Group::all()->each(function($group){
            $group->components = GroupComponent::getComponentNameListByGroupId($group->id);
        });
    }
}
