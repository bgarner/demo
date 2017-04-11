<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FlyerValidator extends PortalValidator
{
    protected $rules = [
    			    'flyer_name' 	=> 'required',
			    	'start'			=> 'required|date',
			    	'end'			=> 'required|date',
			        'document'		=> 'sometimes|required|mimes:csv,txt',
    		];

}
