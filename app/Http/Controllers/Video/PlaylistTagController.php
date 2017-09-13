<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video\PlaylistTag;
use App\Models\Video\Tag;

class PlaylistTagController extends Controller
{
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selected_tags = PlaylistTag::where('playlist_id', $resource_id)->get()->pluck('tag_id');	
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selected_tags', $selected_tags);
    }

    public function store(Request $request)
    {
    	//
    }
}
