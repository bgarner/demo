<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;

class FormGroupBusinessUnitMap extends Model
{
    protected $table = 'form_business_unit_group';
    protected $fillable = ['business_unit_id' , 'group_id'];

    public static function updateGroupBUPivotByGroupId($businessUnit, $group_id)
    {
    	FormGroupBusinessUnitMap::where('group_id', $group_id)->delete();
    	FormGroupBusinessUnitMap::create([
    			'group_id' => $group_id,
    			'business_unit_id' => $businessUnit
    		]);
    }

    public static function getBusinessUnitByGroup($group_id)
    {
    	return Self::where('group_id', $group_id)->first()->business_unit_id;
    }
}
