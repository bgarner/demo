<?php

namespace App\Models\Validation\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class ProductRequestFormInstanceValidator extends PortalValidator
{
    protected $rules = [
                    'department'   => 'required',
                    'category'     => 'required',
                    'requirement'  => 'required',
                    'form_id'      => "required|exists:forms,id",
                    'store_number' => "required|exists:stores,store_number",
                    'submitted_by' => "required",
                    'submitted_by_position' => "required"
                    
    		];

    protected $messages = [

    ];
}
