<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
    protected $table = 'content_tag';
    protected $fillable = ['content_type', 'tag_id', 'content_id']; 


    public static function updateTags($content_type, $id, $tags)
    {
        ContentTag::where('content_type', $content_type)
        		->where('content_id', $id)
        		->delete();

        foreach($tags as $tag) {
            ContentTag::create([
            	'content_type' => $content_type,
            	'content_id'   => $id,
            	'tag_id'       => $tag
            ]);
        }

        return;
    }


    public static function getTagsByContentId($content_type, $id)
    {
    	$tags = ContentTag::join('tags', 'tags.id', '=', 'content_tag.tag_id')
    							->where('content_type', $content_type)
    							->where('content_id', $id)
    							->get()
    							->pluck('tag_id');
    	return $tags;
    }
}
