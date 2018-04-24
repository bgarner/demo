<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FormInstanceGroupMap extends Model
{
    protected $table = 'form_group_form_instance';
    protected $fillable = ['form_group_id', 'form_instance_id'];


    public static function getFormInstancesByGroupId($group_id)
    {
    	return Self::join('form_data', 'form_data.id', '=', 'form_group_form_instance.form_instance_id')
                    ->whereIn('form_group_form_instance.form_group_id', $group_id)
                    ->select('form_data.*')
                    ->orderBy('form_data.created_at', 'desc')
                    ->get()
                    ->each(function($formInstance) {
                        $formInstance->form_data = unserialize($formInstance->form_data);
                        $formInstance->description = $formInstance->form_data['department'] . " > " . $formInstance->form_data['category'] . " > " . $formInstance->form_data['subcategory'];
                        $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
                        $formInstance->assignedToUser = FormInstanceUserMap::getUserByFormInstanceId($formInstance->id);
                        $formInstance->assignedToGroup = FormInstanceGroupMap::getGroupByFormInstanceId($formInstance->id);
                        $formInstance->lastFormAction = FormActivityLog::getLastFormInstanceAction($formInstance->id);

                    });
    }

    public static function updateFormAssignment($form_instance_id, $group_id)
    {
        Self::where('form_instance_id', $form_instance_id)
            ->delete();
        return Self::create([
            'form_instance_id' => $form_instance_id,
            'form_group_id'           => $group_id
        ]);
    }

    public static function getGroupByFormInstanceId($form_instance_id)
    {
        return Self::join('form_usergroups', 'form_usergroups.id', '=', 'form_group_form_instance.form_group_id')
                    ->where('form_group_form_instance.form_instance_id', $form_instance_id)
                    ->select('form_usergroups.*')
                    ->first();
    }
}
