<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class ResourceValidator extends PortalValidator
{
	protected $rules = [ 

			'resource_type'  =>  'required|exists:resource_types,id',
			'resource_id' 	 =>  'required'
			
	];

	protected $messages = [
			'resource_type.required' => 'Resource Type cannot be empty',
			'resource_type.exists' 	 => 'Invalid resource type selected',
			'resource_id.required'	 => 'Resource cannot be empty'			
	];    
}
