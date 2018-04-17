<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormInstanceGroupMap extends Model
{
    protected $table = 'form_group_form_instance';
    protected $fillable = ['form_group_id', 'form_instance_id'];


    public static function getFormInstancesByGroupId($group_id)
    {
    	return Self::join('form_data', 'form_data.id', '=', 'form_group_form_instance.form_instance_id')
                    ->whereIn('form_group_form_instance.form_group_id', $group_id)
                    ->select('form_data.*')
                    ->get()
                    ->each(function($form) {
                        $form->form_data = unserialize($form->form_data);
                    });
    }
}
