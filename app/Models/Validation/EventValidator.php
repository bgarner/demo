<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class EventValidator extends PortalValidator
{   


    protected $rules = [
    	
        'title'          => 'required',
        'event_type'     => 'required|exists:event_types,id',
        'start'          => 'required|date',
        'end'            => 'required|date',
        'target_stores'  => "sometimes|exists:stores,store_number",
        'allStores'      => 'sometimes|in:on,off',
        'target_banners' => 'sometimes|exists:banners,id',
        'store_groups'   => 'sometimes|exists:custom_store_group,id',
            
    ];

    protected $messages = [
        'event_type.exists' => 'Not a valid event type',
        'target_stores'     => 'Target Store missing',
        'allStores.in'      => 'Invalid value in Target Stores'

    ];

}
