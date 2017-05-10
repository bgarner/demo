<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class RoleValidator extends PortalValidator
{
	protected $rules = [ 

			'role_name'  =>  'required',
			'role_id' 	 =>  'sometimes|exists:roles,id',
			'group' 	 =>  'sometimes|exists:groups,id',
			'components' =>  'sometimes|exists:components,id',
			'resource_type'  =>  'sometimes|exists:resource_types,id'
	];

	protected $messages = [
			'role_name.required' => 'Role name cannot be empty',
			'group.exists'		  => 'Invalid Group selected for role',
			'components.exists'	  => 'Invalid Component selected for role',
			'resource_type.exists'	  => 'Invalid Resource selected for role',
	];    
}
