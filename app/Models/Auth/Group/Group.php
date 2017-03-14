<?php

namespace App\Models\Auth\Group;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupComponent;
use App\Models\Auth\Group\GroupRole;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name'];

    public static function createGroup($request)
    {
    	$group = Group::create([
                'name' => $request['group_name']

            ]);
    	GroupRole::createRoleGroupPivotWithGroupId($group, $request);
    	return;

    }

    public static function editGroup($request, $id)
    {
    	$group = Group::find($id);
    	$group['name'] = $request['group_name'];
    	$group->save();
        GroupRole::editRoleGroupPivotByGroupId($request, $id);
    	return $group;
    }

	public static function deleteGroup($id)
	{
		GroupRole::where('group_id', $id)->delete();
        Group::find($id)->delete();
		
	}    

    public static function getGroupList()
    {
    	return Group::all()->lists('name', 'id');
    }

    public static function getGroupDetails()
    {
        return Group::all()->each(function($group){

            $group->roles = GroupRole::getRoleNameListByGroupId($group->id);

        });
    }
}
