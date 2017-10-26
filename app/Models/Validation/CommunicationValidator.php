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
                        'target_stores'         => "sometimes|exists:stores,store_number",
                        'allStores'             => 'sometimes|in:on,off',
                        'target_banners'        => 'sometimes|exists:banners,id',
                        'store_groups'          => 'sometimes|exists:custom_store_group,id',
                        'documents'             => 'sometimes|exists:documents,id',
                        'remove_document'       => 'sometimes|exists:documents,id',

    		];

    protected $messages = [
        'subject'                        => 'Communication title required',
        'communication_type_id.exists'   => 'Invalid communication type',
        'target_stores'                  => 'Target Store missing',
        'allStores'                      => 'Invalid value in Target Stores',
        'documents.exists'               => 'Invalid document attached'

    ];
}
