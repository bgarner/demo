<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class TasklistValidator extends PortalValidator
{
    protected $rules = [
                    'title'          => 'required',
                    'publish_date'   => 'date',
                    'due_date'       => 'required|date|after:publish_date',
                    'remove_tasks'   => 'sometimes|exists:tasks,id',
                    'target_stores'  => "sometimes|exists:stores,store_number",
                    'allStores'      => 'sometimes|in:on,off',
                    'target_banners' => 'sometimes|exists:banners,id',
                    'store_groups'   => 'sometimes|exists:custom_store_groups,id',

    		];

    protected $messages = [
        'title'                          => 'Tasklist title required',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores'

    ];
}
