<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class ProductRequestGroupValidator extends PortalValidator
{
    protected $rules = [
                    
                    "group_name"   => 'required',
                    "form_id"      => 'sometimes|exists:forms,id',
                    "users"        => 'required|exists:users,id',
                    "businessUnit" => 'required|exists:form_business_unit_types,id'
    		];

    protected $messages = [

    ];
}
