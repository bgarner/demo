<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UrgentNoticeValidator extends PortalValidator
{
     protected $rules = [
    	
        'title'          => 'required',
        'start'          => 'required|date',
        'end'            => 'required|date',
        'target_stores'  => "sometimes|exists:stores,store_number",
        'allStores'      => 'sometimes|in:on,off',
        'target_banners' => 'sometimes|exists:banners,id',
        'store_groups'   => 'sometimes|exists:custom_store_group,id',
        'folder'         => 'exists:folder_ids,id',
        'document'       => 'exists:documents,id'
            
    ];

    protected $messages = [
        'target_stores.required_without' => 'Target Store missing',
        'target_stores.array'            => 'Invalid Target Stores',
        'allStores.in'                   => 'Invalid value in Target Stores',
        'folder.exists'                  => 'Invalid attachment',
        'document.exists'                => 'Invalid attachment'

    ];
}   

