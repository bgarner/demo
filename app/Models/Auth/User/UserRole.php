<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    protected $fillable = ['user_id', 'role_id'];

    public static function updateUserRole($user_id, $role_id)
    {
    	$userRole = UserRole::where('user_id', $user_id)
    			->first()->update(['role_id' => $role_id]);

    	return;
    }

    public static function getFormUsersByRoleList($roleList)
    {
        return UserRole::join('users', 'users.id', '=', 'user_role.user_id')
                        ->whereIn('role_id', $roleList)
                        ->where('users.group_id', 3)
                        ->select('users.*')
                        ->get();  
    }

    public static function getUserListByRoleId($RoleId)
    {
        return Self::where('role_id', $RoleId)
            ->get()->pluck('user_id')->toArray();
    }

}
