<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class GroupSection extends Model
{
    protected $table = 'group_section';
    protected $fillable = ['group_id', 'section_id'];

    public static function getGroupListBySectionId($id)
    {
    	$groups = GroupSection::where('section_id', $id)->get()->pluck('group_id')->toArray();
    	return $groups;
    }
    public static function getsectionListByGroupId($id)
    {
    	$sections = GroupSection::where('group_id', $id)->get()->pluck('section_id')->toArray();
    	return $sections;
    }

    public static function createSectionGroupPivotWithSectionId($section, $request)
    {
    	foreach ($request['groups'] as $group_id) {
    		GroupSection::create([
    			'section_id' => $section->id,
    			'group_id' => $group_id

    		]);	
    	}
    	
    }
    public static function createSectionGroupPivotWithGroupId($group, $request)
    {
    	foreach ($request['sections'] as $section_id) {
    		GroupSection::create([
    			'group_id' => $group->id,
    			'section_id' => $section_id

    		]);	
    	}
    	
    }
    public static function editSectionGroupPivotBySectionId($request, $id)
    {
    	GroupSection::where('section_id', $id)->delete();
    	foreach ($request['groups'] as $group_id) {
    		GroupSection::create([
    				'section_id' => $id,
    				'group_id'	=> $group_id
    			]);
    	}
    }
    public static function editSectionGroupPivotByGroupId($request, $id)
    {
    	GroupSection::where('group_id', $id)->delete();
    	foreach ($request['sections'] as $section_id) {
    		GroupSection::create([
    				'group_id' => $id,
    				'section_id'	=> $section_id
    			]);
    	}
    }
}
