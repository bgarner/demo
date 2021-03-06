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
    	$selectedTags = [];
    	return view('admin.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags);
    }
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selectedTags = ContentTag::getTagsByContentId('playlist', $resource_id);
        
    	return view('admin.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags)
                ->with('resourceId', $resource_id);
    }

    public function store(Request $request)
    {
    	$playlist_id = $request->playlist_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'playlist', $playlist_id, $tags);
    	return;
    }
}
