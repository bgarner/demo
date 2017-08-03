<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class ComponentValidator extends PortalValidator
{
	protected $rules = [ 
			'component_name'  =>  'required',
			'roles' 	 	  =>  'sometimes|exists:roles,id',
			'component_id'	  =>  'sometimes|exists:components,id'
	];

	protected $messages = [
			'component_name.required' => 'Component name cannot be empty',
			'roles.exists'		  	  => 'Invalid Role selected for component',
			'components.exists'		  => 'Invalid Id selected for component',
	];    
}
