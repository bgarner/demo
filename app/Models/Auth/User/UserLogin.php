<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserLogin extends Model
{
    protected $table = 'user_login';

    protected $fillable = ['user_id'];


    public static function addUserLogin($user_id)
    {
    	Self::create([
    		'user_id' => $user_id
    	]);
    }

    public static function getManagerLoginsSinceLastWeek()
    {
    	
    	$lastWeek = Carbon::now()->subDays(7)->startOfDay()->toDateTimeString();
    	$loginCount = UserLogin::join('users', 'users.id', '=', 'user_login.user_id')
    							->where('user_login.created_at', '>=', $lastWeek)
    							->where('group_id' , 2)
    							->select(\DB::raw('users.id, users.firstname, users.lastname, users.last_login, count(user_login.user_id) as count'))
    							->groupBy('user_login.user_id')
    							->get();
    	return ($loginCount);
    }
}
