<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = ['form_name', 'version', 'form_structure'];

    public static function getFormsByAdminId($id)
    {
        return Form::all();
    }

    public static function getFormIdByFormNameAndVersion($formName, $formVersion)
    {
    	$formId = Form::where('form_name', $formName)
    				->where('version', $formVersion)
    				->first()->id;

    	return $formId;
    }
    
}
