<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\UserRole;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = ['form_name', 'version', 'form_structure'];

    
    public static function getFormList()
    {
        return Form::pluck( 'form_label', 'id');

    }


    public static function getFormsByAdminRoleId()
    {

        $formIds = FormRoleMap::getFormListByRoleId();

        $forms = Form::whereIn('id', $formIds)
                    ->select('forms.*')
                    ->get()
                    ->each(function($form){
                        $form->count_new = FormData::getNewFormInstanceCount( $form->id);
                        $form->count_in_progress = FormData::getInProgressFormInstanceCount($form->id);
                    });

        
        return $forms;
    }

    public static function getFormIdByFormNameAndVersion($formName, $formVersion)
    {
    	$formId = Form::where('form_name', $formName)
    				->where('version', $formVersion)
    				->first()->id;

    	return $formId;
    }

    public static function getFormListByRoleId()
    {
        $formIds = FormRoleMap::getFormListByRoleId();
        return Form::whereIn('id', $formIds)->pluck('form_label', 'id')->prepend('Select one', '');
    }
    
}
