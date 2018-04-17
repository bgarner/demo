<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormInstanceUserMap extends Model
{
    protected $table = 'form_user_form_instance';
    protected $fillable = ['user_id', 'form_instance_id'];

    public static function getFormInstancesByUserId($user_id)
    {
        return Self::join('form_data', 'form_data.id', '=', 'form_user_form_instance.form_instance_id')
                    ->where('form_user_form_instance.user_id', $user_id)
                    ->select('form_data.*')
                    ->get()
                    ->each(function($form) {
                        $form->form_data = unserialize($form->form_data);
                    });
    }
}
