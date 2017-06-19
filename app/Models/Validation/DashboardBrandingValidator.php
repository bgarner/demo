<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class DashboardBrandingValidator extends PortalValidator
{
    protected $rules = [
    	'title'              => 'sometimes|required',
    	'background'         => 'sometimes|required|mimes:jpeg,jpf,png,bmp,gif',
    	'update_type_id'     => 'sometimes|in:1,2',
    	'update_window_size' => 'sometimes|integer|min:1'

    ];
}
