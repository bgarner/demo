<?php

namespace App\Models\Auth\Group;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Group\GroupComponent;
use App\Models\Auth\Group\GroupRole;
use App\Models\Validation\GroupValidator;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name'];

    
    public static function validateGroup($request)
    {
        $validateThis = [
            'group_name' => $request['group_name']
            
        ];

        if(isset($request['roles']) && $request['roles']){
            $validateThis['roles'] = $request['roles'];
        }

        \Log::info($validateThis);
        $v = new GroupValidator();
          
        return $v->validate($validateThis);
    }

    public static function createGroup($request)
    {
    	
        $validate = Self::validateGroup($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }

        $group = Group::create([
                'name' => $request['group_name']

            ]);
    	GroupRole::createRoleGroupPivotWithGroupId($group, $request);
    	return $group;

    }

    public static function editGroup($request, $id)
    {
    	$validate = Self::validateGroup($request);
        
        if($validate['validation_result'] == 'false') {
          return $validate;
        }

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
    	return Group::all()->pluck('name', 'id')->prepend('Select one', '');
    }

    public static function getGroupDetails()
    {
        return Group::all()->each(function($group){

            $group->roles = GroupRole::getRoleNameListByGroupId($group->id);

        });
    }

    public static function getGroupNamesList()
    {
        $defaultSelection = [''=>'Select one'];
        $group_names = $defaultSelection + Group::all()->pluck('name', 'id')->toArray();
        return $group_names;

    }
}
