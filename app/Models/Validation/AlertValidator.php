<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class AlertValidator extends PortalValidator
{
    protected $rules = [
                        'document_id'    => 'required|exists:documents,id',
                        'alert_type_id'  => 'required|exists:alert_types,id'
    		];

    protected $messages = [
    				'document_id.required'   => 'Document is required',
    				'document_id.exists'     => 'The selected document is invalid',
    				'alert_type_id.required' => 'Alert type is required',
    				'alert_type_id.exists'   => 'The selected alert type is invalid',

    		];

}
