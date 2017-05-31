<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;

class UserBanner extends Model
{
    protected $table = 'banner_user';

    protected $fillable = ['banner_id', 'user_id'];

    public static function updateAdminBanner($user_id, $banners)
    {
    	UserBanner::where('user_id', $user_id)->delete();
    	foreach ($banners as $banner) {
    		UserBanner::create([
    			'user_id' => $user_id,
    			'banner_id'	=> $banner
    		]);
    	}
    }

    public static function getAllBanners()
    {
        $user_id = \Auth::user()->id;
        return UserBanner::join('banners', 'banner_user.banner_id', '=', 'banners.id')
                ->where('user_id', $user_id)
                ->select('banners.*')
                ->get();

    }
}
