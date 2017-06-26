<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class CustomStoreGroupValidator extends PortalValidator
{
    protected $rules = [
                        'group_name'      => 'required|unique:custom_store_group,group_name',
                        'target_stores'   => "required",

    		];

    protected $messages = [
        'subject'                        => 'Communication title required',
        'communication_type_id.'         => 'Invalid communication type',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores',
        'documents.exists'               => 'Invalid document attached'

    ];
}
