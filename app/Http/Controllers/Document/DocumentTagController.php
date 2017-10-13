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
    	$selectedTags = [];
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags);
    }
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selectedTags = ContentTag::getTagsByContentId('document', $resource_id);
    	return view('admin.video.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags);
    }

    public function store(Request $request)
    {
    	$document_id = $request->document_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'document', $document_id, $tags);
    	return;
    }
}
