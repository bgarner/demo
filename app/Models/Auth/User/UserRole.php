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
    			->first();

    	$userRole['role_id'] = $role_id;
    	$userRole->save();

    	return;
    }

}
