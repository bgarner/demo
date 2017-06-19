<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class CommunicationValidator extends PortalValidator
{
    protected $rules = [
                        'subject'               => 'required',
                        'communication_type_id' => 'exists:communication_types,id',
                        'start'                 => 'required|date',
                        'end'                   => 'required|date',
                        'target_stores'         => "required_without:allStores",
                        'allStores'             => 'in:on',
                        'documents'             => 'sometimes|exists:documents,id',
                        'remove_document'       => 'sometimes|exists:documents,id',

    		];

    protected $messages = [
        'subject'                        => 'Communication title required',
        'communication_type_id.'         => 'Invalid communication type',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores',
        'documents.exists'               => 'Invalid document attached'

    ];
}
