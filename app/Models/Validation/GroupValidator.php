<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class GroupValidator extends PortalValidator
{
	protected $rules = [ 

			'group_name' => 'required',
			'roles' 	 =>  'sometimes|exists:roles,id'
	];

	protected $messages = [
			'group_name.required' => 'Group name cannot be empty',
			'roles.exists'		 => 'Invalid Role selected for group'
	];    
}
