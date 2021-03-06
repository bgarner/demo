<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserRole;
use App\Models\Validation\UserValidator;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getRoleIdAttribute()
    {
        return UserRole::where('user_id', \Auth::user()->id)->first()->role_id;
    }

    public function getRoleAttribute()
    {
        return UserRole::join('roles', 'roles.id', '=', 'user_role.role_id')
                        ->where('user_id', \Auth::user()->id)
                        ->select('roles.*')
                        ->first()->role_name;
    }
}
