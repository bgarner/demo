<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class VideoValidator extends PortalValidator
{
    protected $rules = [
    			    'title' 		=> 'sometimes',
			    	'filename'  => 'required|mimes:webm'

    		];

    protected $messages = [

    ];
}
