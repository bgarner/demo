<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';

    public static function getGroupNamesList()
    {
		$defaultSelection = [''=>'Select one'];
		$group_names = $defaultSelection + UserGroup::all()->lists('name', 'id')->toArray();
		return $group_names;

    }
}
