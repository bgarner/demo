<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FormInstanceGroupMapValidator extends PortalValidator
{
    protected $rules = [
                    'form_instance_id'  => 'required|exists:form_data,id',
                    'form_group_id' => 'required|exists:form_usergroups,id'
            ];

    protected $messages = [
        'form_instance_id.exists' => 'An error occurred with the form'
    ];
}
