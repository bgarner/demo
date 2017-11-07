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
    	
    	$selectedTags = ContentTag::getTagsByContentId('video', $resource_id);


    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags)
                ->with('videoId', $resource_id);
    }

    public function store(Request $request)
    {
    	$video_id = $request->video_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'video', $video_id, $tags);
    	return;
    }
}
