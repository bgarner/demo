<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['role_name'];

    public static function getRoleByUserId($user_id)
    {
    	return Role::join('user_role', 'user_role.role_id', '=', 'roles.id')
    		->where('user_id', $user_id)
    		->first()->role_name;
    }
}
