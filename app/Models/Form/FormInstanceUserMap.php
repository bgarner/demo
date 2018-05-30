<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Validation\Form\FormInstanceUserMapValidator;

class FormInstanceUserMap extends Model
{
    protected $table = 'form_user_form_instance';
    protected $fillable = ['user_id', 'form_instance_id'];

    public static function validateFormInstanceUser($form_instance_id, $user_id)
    {
        $validateThis = [
                            "form_instance_id"  => $form_instance_id,
                            "user_id" => $user_id

                        ]; 

        \Log::info($validateThis);
        $v = new FormInstanceUserMapValidator();

        return $v->validate($validateThis);
    }

    public static function getFormInstancesByUserId($user_id)
    {
        return Self::join('form_data', 'form_data.id', '=', 'form_user_form_instance.form_instance_id')
                    ->where('form_user_form_instance.user_id', $user_id)
                    ->select('form_data.*')
                    ->orderBy('form_data.created_at', 'desc')
                    ->get()
                    ->each(function($formInstance) {
                        $formInstance->form_data = unserialize($formInstance->form_data);
                        $formInstance->description = $formInstance->form_data['department'] . " > " . $formInstance->form_data['category'] . " > " . $formInstance->form_data['subcategory']. " > " . $formInstance->form_data['gender'];
                        $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
                        $formInstance->assignedToUser = FormInstanceUserMap::getUserByFormInstanceId($formInstance->id);
                        $formInstance->assignedToGroup = FormInstanceGroupMap::getGroupByFormInstanceId($formInstance->id);
                        $formInstance->lastFormAction = FormActivityLog::getLastFormInstanceAction($formInstance->id);

                    });
    }

    public static function getUserByFormInstanceId($formInstanceId)
    {
        return Self::join('users', 'users.id', '=', 'form_user_form_instance.user_id')
                    ->where('form_user_form_instance.form_instance_id', $formInstanceId)
                    ->select('users.*')
                    ->first();
    }

    public static function updateFormAssignment($form_instance_id, $user_id)
    {
        $validate = Self::validateFormInstanceUser($form_instance_id, $user_id);

        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        Self::where('form_instance_id', $form_instance_id)
            ->delete();
        return Self::create([
            'form_instance_id' => $form_instance_id,
            'user_id'           => $user_id
        ]);
    }
}
