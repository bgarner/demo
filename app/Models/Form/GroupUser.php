<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'form_group_user';
    protected $fillable = ['form_group_id', 'user_id'];

    public static function updateGroupUserPivotByGroupId($users, $group_id)
    {
    	GroupUser::where('form_group_id', $group_id)->delete();
    	foreach ($users as $user) {
    		GroupUser::create([
    			'form_group_id' => $group_id,
    			'user_id'	=> $user
    		]);
    	}
    }

    public static function getUsersByGroupId($group_id)
    {
    	return GroupUser::where('form_group_id', $group_id)->pluck('user_id');
    }

    public static function getGroupsByUserId($user_id)
    {
        return GroupUser::where('user_id', $user_id)->get()->pluck('form_group_id')->toArray();
    }

    
}
