<?php

namespace App\Models\Auth\Group;

use Illuminate\Database\Eloquent\Model;

class GroupRole extends Model
{
    protected $table = 'group_role';

    protected $fillable = ['group_id', 'role_id'];

    public static function getRoleNameListByGroupId($id)
    {
    	$roles = GroupRole::join('roles', 'group_role.role_id', '=', 'roles.id' )
    						->where('group_role.group_id', $id)
    						->select('roles.id', 'roles.role_name')
    						->get();
    	return $roles;
    }

    public static function getGroupNameListByRoleId($id)
    {
        $groups = GroupRole::join('groups', 'group_role.group_id', '=', 'groups.id' )
                            ->where('group_role.role_id', $id)
                            ->select('groups.id', 'groups.name')
                            ->get();
        return $groups;   
    }

    public static function getRoleListByGroupId($id)
    {
        $roles = GroupRole::where('group_id', $id)->get()->pluck('role_id')->toArray();
        return $roles;
    }
    public static function getGroupListByRoleId($id)
    {
        $group = GroupRole::where('role_id', $id)->first();
        if($group){
            return $group->group_id;    
        }
        else{
            return null;
        }
        
    }

    public static function createRoleGroupPivotWithGroupId($group, $request)
    {
        if( isset($request['roles']) && (count($request['roles']) > 0) )
        {
            foreach ($request['roles'] as $role_id) {
                GroupRole::create([
                    'group_id' => $group->id,
                    'role_id' => $role_id

                ]); 
            }
        }
    }

    public static function createRoleGroupPivotWithRoleId($role, $request)
    {
        
        GroupRole::create([
            'role_id' => $role->id,
            'group_id' => $request->group
        ]); 
        
    }

    public static function editRoleGroupPivotByGroupId($request, $id)
    {
        GroupRole::where('group_id', $id)->delete();
        GroupRole::create([
            'group_id' => $id,
            'role_id'  => $role_id
        ]);
    
    }
    public static function editRoleGroupPivotByRoleId($request, $id)
    {
        GroupRole::where('role_id', $id)->delete();
        GroupRole::create([
            'role_id' => $id,
            'group_id'  => $request->group
        ]);
    }

}
