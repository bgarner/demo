<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\GroupSection;

class Section extends Model
{
    protected $table = 'sections';
    protected $fillable = ['section_name', 'banner_id'];

    public static function createSection($request)
    {
    	$section = Section::create([
                'section_name' => $request['section_name'],
                'banner_id' => $request['banner_id']

            ]);
    	GroupSection::createSectionGroupPivotWithSectionId($section, $request);
    	return;

    }

    public static function editSection($request, $id)
    {
    	$section = Section::find($id);
    	$section['section_name'] = $request['section_name'];
    	$section->save();
    	GroupSection::editSectionGroupPivotBySectionId($request, $id);
    	return $section;
    }

	public static function deleteSection($id)
	{
		Section::find($id)->delete();
		GroupSection::where('section_id', $id)->delete();
	}    

	public static function getSectionList($banner_id)
    {
    	return Section::where('banner_id', $banner_id)->get()->lists('section_name', 'id');
    }
    

    public static function getSectionDetails()
    {
        return Section::all()->each(function($section){
            $section->groups = GroupSection::getGroupNameListBySectionId($section->id);
        });
    }
}
