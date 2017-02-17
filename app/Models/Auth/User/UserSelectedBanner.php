<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;

class UserSelectedBanner extends Model
{
    protected $table = 'user_selected_banner';
    protected $fillable = ['user_id', 'selected_banner_id'];

    public static function getBanner()
    {
    	$user_id = \Auth::user()->id;
    	$selected_banner_id = UserSelectedBanner::where('user_id', $user_id)->first()->selected_banner_id;
    	$selected_banner = Banner::where('id', $selected_banner_id)->first();
    	return $selected_banner;
    }
}
