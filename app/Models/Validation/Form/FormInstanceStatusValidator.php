<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FormInstanceStatusValidator extends PortalValidator
{
    protected $rules = [
                    'form_data_id'  => 'required|exists:form_data,id',
                    'status_code_id' => 'required|exists:form_status_code,id'
    		];

    protected $messages = [
    	
        'status_code_id.exists' => 'Invalid Status Code'
    ];
}
