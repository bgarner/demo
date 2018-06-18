<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FormInstanceUserMapValidator extends PortalValidator
{
    protected $rules = [
                    
                'form_instance_id'  => 'required|exists:form_data,id',
                'user_id' => 'required|exists:users,id'
            ];

    protected $messages = [
        'form_instance_id.exists' => 'An error occurred with the form'
    ];
}
