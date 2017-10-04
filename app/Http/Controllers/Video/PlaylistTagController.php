<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tag\ContentTag;
use App\Models\Tag\Tag;

class PlaylistTagController extends Controller
{
    public function create()
    {
    	$tags = Tag::all()->pluck('name', 'id');	
    	$selected_tags = [];
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selected_tags', $selected_tags);
    }
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selected_tags = ContentTag::where('content_id', $resource_id)->where('content_type', 'playlist')->get()->pluck('tag_id');	
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selected_tags', $selected_tags);
    }

    public function store(Request $request)
    {
    	$playlist_id = $request->playlist_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'playlist', $playlist_id, $tags);
    	return;
    }
}
