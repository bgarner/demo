<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;

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

        return view('site.tag.index')
            ->with('tagId', $tagId);
    }
}
