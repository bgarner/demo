<?php

namespace App\Models\HelpSection;

use Illuminate\Database\Eloquent\Model;

class HelpSection extends Model
{
    protected $table = 'help_section';

    public static function getHelpSection($parentView, $section)
    {
    	return HelpSection::where('parent_view', $parentView)
    				->where('section', $section)
    				->first();
    }
}
