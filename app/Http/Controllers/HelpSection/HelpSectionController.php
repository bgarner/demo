<?php

namespace App\Http\Controllers\HelpSection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HelpSection\HelpSection;

class HelpSectionController extends Controller
{
    public function show(Request $request)
    {
    	
    	return HelpSection::getHelpSection($request->parentView, $request->section);

    }
}
