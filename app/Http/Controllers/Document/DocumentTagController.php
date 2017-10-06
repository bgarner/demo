<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag\ContentTag;
use App\Models\Tag\Tag;

class DocumentTagController extends Controller
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
    	
    	$selected_tags = ContentTag::where('content_id', $resource_id)->where('content_type', 'document')->get()->pluck('tag_id');	
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selected_tags', $selected_tags);
    }

    public function store(Request $request)
    {
    	$document_id = $request->document_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'document', $document_id, $tags);
    	return;
    }
}
