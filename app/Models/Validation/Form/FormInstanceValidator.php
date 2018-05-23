<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class FormInstanceValidator extends PortalValidator
{
    protected $rules = [
                    
                    'form_id'      => "required|exists:forms,id",
                    'store_number' => "required|exists:stores,store_number",
                    'submitted_by' => "required"

                    
    		];

}
