<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class ProductRequestGroupValidator extends PortalValidator
{
    protected $rules = [
                    'title'           => 'required',
                    'publish_date'    => 'date',
                    'due_date'        => 'required|date|after:publish_date',
                    'target_stores'   => "sometimes|exists:stores,store_number",
                    'allStores'       => 'sometimes|in:on,off',
                    'target_banners'  => 'sometimes|exists:banners,id', 
                    'store_groups'    => 'sometimes|exists:custom_store_groups,id',
                    'documents'       => 'sometimes|exists:documents,id',
                    'remove_document' => 'sometimes|exists:documents,id',
    		];

    protected $messages = [
        'subject'                        => 'Task title required',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores',
        'documents.exists'               => 'Invalid document attached'

    ];
}
