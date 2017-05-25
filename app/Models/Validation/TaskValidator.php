<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class TaskValidator extends PortalValidator
{
    protected $rules = [
    			    'title' 		=> 'required',
			    	'publish_date'	=> 'date',
			    	'due_date'		=> 'required|date|after:publish_date',
			    	'target_stores'	=> "required_without:allStores",
			        'allStores'     => 'in:on',
			        'documents'		=> 'sometimes|exists:documents,id',
			        'remove_document'=> 'sometimes|exists:documents,id',
    		];

    protected $messages = [
    	'subject' 					=> 'Task title required',
        'target_stores.required_without' => 'Target Store missing',
        'allStores.in' 				=> 'Invalid value in Target Stores',
        'documents.exists' 			=> 'Invalid document attached'  

    ];
}
