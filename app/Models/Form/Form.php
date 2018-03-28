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

    

    public static function getFormsByAdminId($id)
    {
        $role_id = UserRole::where('user_id', $id)->first()->role_id;

        $forms = Form::join('form_role', 'forms.id', '=', 'form_role.form_id' )
                            ->where('form_role.role_id', $role_id)
                            ->select('forms.*')
                            ->get();

        foreach ($forms as $form) {
            

            $form->count_new = FormData::getNewFormInstanceCount( $form->id);
            $form->count_in_progress = FormData::getInProgressFormInstanceCount($form->id);
        }
        return $forms;
    }

    public static function getFormIdByFormNameAndVersion($formName, $formVersion)
    {
    	$formId = Form::where('form_name', $formName)
    				->where('version', $formVersion)
    				->first()->id;

    	return $formId;
    }
    
}
