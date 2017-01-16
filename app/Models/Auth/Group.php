<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'user_groups';
    protected $fillable = ['name'];

    public static function getGroupList($banner_id)
    {
    	return Group::all()->lists('name', 'id');
    }
}
