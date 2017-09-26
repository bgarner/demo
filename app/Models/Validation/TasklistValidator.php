<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class TasklistValidator extends PortalValidator
{
    protected $rules = [
                    'title'         => 'required',
                    'publish_date'  => 'date',
                    'due_date'      => 'required|date|after:publish_date',
                    'target_stores' => "required_without:allStores",
                    'allStores'     => 'in:on',
                    'remove_tasks'  => 'sometimes|exists:tasks,id',
    		];

    protected $messages = [
        'title'                          => 'Tasklist title required',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores'

    ];
}
