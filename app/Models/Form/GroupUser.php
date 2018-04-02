<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'form_group_user';
    protected $fillable = ['group_id', 'user_id'];

    public static function createGroupUserPivotByGroupId($request, $group_id)
    {
    	foreach ($request->users as $user) {
    		GroupUser::create([
    			'group_id' => $group_id,
    			'user_id'	=> $user_id
    		]);
    	}
    }
}
