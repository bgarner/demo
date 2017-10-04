<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\UserSelectedBanner;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';
    protected $fillable = ['name', 'banner_id'];
    protected $dates = ['deleted_at'];

    public static function storeTag($request)
    {
        $banner = UserSelectedBanner::getBanner();
        $tag = Tag::create([
            'name' => $request['tag_name']
        ]);
        return $tag;
    }

    public static function updateTag($id, $request)
    {   
        $tag = Tag::find($id);
        $tag->name = $request["tag_name"];
        $tag->save();
        return;
    }
}
