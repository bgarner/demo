<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FlyerItemValidator extends PortalValidator
{
    protected $rules = [
			        'flyer_id' 		=> 'required|exists:flyers,id'
    		];

}
