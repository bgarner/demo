<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class EventValidator extends PortalValidator
{   


    protected $rules = [
    	
        'title'                          => 'required',
        'event_type'                     => 'required|integer|min:0',
        'start'                          => 'required|date',
        'end'                            => 'required|date',
        'target_stores'                  => "required_without:allStores",
        'allStores'                      => 'in:on'
            
    ];

    protected $messages = [
        'event_type.min'                 => 'Not a valid event type',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in'                   => 'Invalid value in Target Stores'

    ];

}
