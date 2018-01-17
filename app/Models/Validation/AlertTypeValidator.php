<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class AlertTypeValidator extends PortalValidator
{
	protected $rules = [ 'alert_type' => 'required' ];

	protected $messages = [
			'alert_type' => 'Alert type cannot be empty'
	];    
}
