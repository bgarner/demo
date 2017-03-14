<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserSelectedBanner;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';
    protected $fillable = ['name', 'banner_id'];
    protected $dates = ['deleted_at'];

    public static function storeTag($request)
    {
        $banner = UserSelectedBanner::getBanner();
    	Tag::create([
    		'name' => $request['tag_name'],
    		'banner_id' => $banner->id
    	]);
    	return;
    }

    public static function updateTag($id, $request)
    {	
    	$tag = Tag::find($id);
    	$tag->name = $request["tag_name"];
    	$tag->save();
    	return;
    }	
}
