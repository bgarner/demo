<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;

class FormGroupBusinessUnitMap extends Model
{
    protected $table = 'form_business_unit_group';
    protected $fillable = ['business_unit_id' , 'group_id'];

    public static function updateGroupBUPivotByGroupId($businessUnit, $group_id)
    {
    	FormGroupBusinessUnitMap::where('group_id', $group_id)->delete();
    	foreach ($businessUnit as $bu) {
            FormGroupBusinessUnitMap::create([
                'group_id' => $group_id,
                'business_unit_id' => $bu
            ]);
        }
        
    }

    public static function getBusinessUnitByGroup($group_id)
    {
    	return Self::where('group_id', $group_id)->get()->pluck('business_unit_id')->toArray();
    }

    public static function getGroupsByCurrentBusinessUnitId()
    {
        $currentBusinessUnit = FormUserBusinessUnitMap::where('user_id', \Auth::user()->id)->first()->business_unit_id;
        
        return Self::join('form_usergroups', 'form_usergroups.id', '=', 'form_business_unit_group.group_id')
                ->where('business_unit_id', $currentBusinessUnit)
                ->select('form_usergroups.*')
                ->get();
    }

}
