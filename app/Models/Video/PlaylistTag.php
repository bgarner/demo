<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class PlaylistTag extends Model
{
    protected $table = 'playlist_tags';
    protected $fillable = ['playlist_id', 'tag_id'];

    public static function updateTags($id, $tags)
    {
        PlaylistTag::where('playlist_id', $id)->delete();
        foreach ($tags as $tag) {
            PlaylistTag::create([
               'playlist_id' => $id,
               'tag_id'   => $tag
            ]);
        }

        return;
    }
    public static function getTagsByPlaylistId($id)
    {
    	$tags = PlaylistTag::join('tags', 'tags.id', '=', 'playlist_tags.tag_id')
    							->where('playlist_id', $id)
    							->get()
    							->pluck('tag_id');
    	return $tags;
    }
    
}
