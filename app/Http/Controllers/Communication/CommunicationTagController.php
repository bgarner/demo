<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;

class CommunicationTagController extends Controller
{
    public function show($resource_id)
    {
    	$tags = Tag::all()->pluck('name', 'id');
    	
    	$selectedTags = ContentTag::getTagsByContentId('communication', $resource_id);
                                
    	return view('admin.tag.tag-partial')
    			->with('tags', $tags)
    			->with('selectedTags', $selectedTags)
                ->with('resourceId', $resource_id);
    }

    public function store(Request $request)
    {
    	$communication_id = $request->communication_id;
    	$tags = $request->tags;
    	ContentTag::updateTags( 'communication', $communication_id, $tags);
    	return;
    }
}
