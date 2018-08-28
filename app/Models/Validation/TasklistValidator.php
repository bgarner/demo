<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class TasklistValidator extends PortalValidator
{
    protected $rules = [
                    'title'          => 'required',
                    'tasks'          => 'sometimes|exists:tasks,id'
    		];

    protected $messages = [
        'title'                          => 'Tasklist title required'

    ];
}
