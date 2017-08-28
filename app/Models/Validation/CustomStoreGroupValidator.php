<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class CustomStoreGroupValidator extends PortalValidator
{
    protected $rules = [
                        'group_name'      => 'sometimes|unique:custom_store_group,group_name',
                        'target_stores'   => "required",

    		];

    protected $messages = [
    	'group_name.regex' => 'Group name not valid',
    ];
}
