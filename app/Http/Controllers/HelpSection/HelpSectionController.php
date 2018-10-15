<?php

namespace App\Http\Controllers\HelpSection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HelpSection\HelpSection;

class HelpSectionController extends Controller
{
    public function show(Request $request)
    {
    	
    	$parentView = $request->parentView;
    	$section = $request->section;

    	return HelpSection::where('parent_view', $parentView)
    				->where('section', $section)
    				->first();


    }
}
