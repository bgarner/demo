<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;

class TagController extends Controller
{
    /**
     * Instantiate a new TagController instance.
     */
    public function __construct()
    {
        //
    }

    public function index($storeno, $tagname)
    {
        $tagId = Tag::getTagIdByTagName($tagname);

        $content = ContentTag::getContentByTagId($tagId);

        return view('site.tag.index')
            ->with('content', $content)
            ->with('tagId', $tagId);
    }
}
