<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormRoleMap extends Model
{
    protected $table = 'form_role';

    public static function getRoleListByFormId($formId)
    {
    	return Self::where('form_id', $formId)->get()->pluck('role_id')->toArray();
    }
    
}
