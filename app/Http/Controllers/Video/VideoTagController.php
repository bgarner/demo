<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag\ContentTag;
use App\Models\Tag\Tag;

class VideoTagController extends Controller
{
    
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selected_tags = ContentTag::where('content_type', 'video')
                                    ->where('content_id', $resource_id)
                                    ->get()
                                    ->pluck('tag_id');	

    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selected_tags', $selected_tags);
    }

    public function store(Request $request)
    {
    	$video_id = $request->video_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'video', $video_id, $tags);
    	return;
    }
}
