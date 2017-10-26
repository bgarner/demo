<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Video\Video;
use App\Models\Video\Playlist;
use App\Models\Document\Document;
use App\Models\Communication\Communication;
use App\Models\Tag\Tag;

class ContentTag extends Model
{
    protected $table = 'content_tag';
    protected $fillable = ['content_type', 'tag_id', 'content_id'];


    public static function updateTags($content_type, $id, $tags)
    {
        ContentTag::where('content_type', $content_type)
        		->where('content_id', $id)
        		->delete();

        if(isset($tags)){
            \Log::info("tags from ContentTag");
            \Log::info($tags);
            foreach($tags as $tag) {
                ContentTag::create([
                    'content_type' => $content_type,
                    'content_id'   => $id,
                    'tag_id'       => $tag
                ]);
            }
        }
        return;
    }

    public static function getTagsForContent($content_type, $id)
    {
        $tags = ContentTag::where('content_type', $content_type)
                        ->where('content_id', $id)
                        ->get();

        foreach($tags as $t){
            $t->name = Tag::getTagName($t);
            $t->linkname = str_replace(" ","-",$t->name);
        }

        return $tags;
    }

    public static function getTagsByContentId($content_type, $id)
    {
    	$tags = ContentTag::where('content_type', $content_type)
						->where('content_id', $id)
						->get()
						->pluck('tag_id')->toArray();
    	return $tags;
    }

    public static function getContentByTagId($id)
    {
        $content = ContentTag::where('tag_id', $id)->get();
        $contentCollection = collect();

        foreach($content as $c){
            if(ContentTag::checkContentExpiry($c)){
                continue;
            } else {
                $contentCollection->push($c);
            }
        }

        return $contentCollection;
    }

    public static function getContentByTagIdWithArchive($id)
    {
        return ContentTag::where('tag_id', $id)->get();
    }

    public static function checkContentExpiry($content)
    {
        $today = Date('Y')."-".Date('m')."-".Date('d');

        switch($content->content_type){

            case "video": //never expires
                $exp ="";
                break;

            case "playlist": //never expires
                $exp ="";
                break;

            case "document":
                $exp = Document::where('id', $content->id)
                        ->where('end', '>=', $today)
                        ->orWhere('end', '=', '0000-00-00 00:00:00')
                        ->pluck('id');
                break;

            case "communication":
                $exp = Communication::where('id', $content->id)
                        ->where('archive_at', '>=', $today)
                        ->orWhere('archive_at', '=', '0000-00-00 00:00:00')
                        ->pluck('id');
                break;
        }

        if($exp !=""){
            return true;
        }
        return false;
    }
}
