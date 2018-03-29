<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormRoleMap extends Model
{
    protected $table = 'form_role';

    protected $fillable = ['form_id', 'role_id'];

    public static function getRoleListByFormId($formId)
    {
    	return Self::where('form_id', $formId)->get()->pluck('role_id')->toArray();
    }

    public static function createFormRolePivotWithRoleId($role, $request)
    {
    	foreach ($request->forms as $form) {
    		Self::create([
	            'role_id' => $role->id,
	            'form_id' => $form
        	]); 
    	}
    	
    }

    public static function getFormListByRoleId()
    {
        return FormRoleMap::where('role_id', \Auth::user()->role_id)->get()->pluck('form_id')->toArray();
    }
    
}
