<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoTag extends Model
{
    use SoftDeletes;

    protected $table = 'video_tags';
    protected $fillable = ['video_id', 'tag_id'];
    protected $dates = ['deleted_at'];

    public static function updateTags($id, $tags)
    {
        VideoTag::where('video_id', $id)->delete();
        foreach ($tags as $tag) {
            VideoTag::create([
               'video_id' => $id,
               'tag_id'   => $tag
            ]);
        }

        return;
    }
    
    public static function getTagsByVideoId($id)
    {
    	$tags = VideoTag::join('tags', 'tags.id', '=', 'video_tags.tag_id')
    							->where('video_id', $id)
    							->get()
    							->pluck('tag_id');
    	return $tags;
    }
}
