<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UrgentNoticeValidator extends PortalValidator
{
     protected $rules = [
    	
        'title' 		=> 'required',
    	'start'			=> 'required|date',
    	'end'			=> 'required|date',
    	'target_stores'	=> "required_without:allStores|array",
    	'allStores'     => 'in:on',
        'attachment_type_id' => 'required_with:folder,document|in:1,2,3',
        'folder'        => 'required_if:attachment_type_id,1|exists:folder_ids,id',
        'document'      => 'required_if:attachment_type_id,2|exists:documents,id'
            
    ];

    protected $messages = [
        'target_stores.required_without' => 'Target Store missing',
        'target_stores.array' => 'Invalid Target Stores',
        'allStores.in' => 'Invalid value in Target Stores',
        'folder.exists' => 'Invalid attachment',
        'document.exists' => 'Invalid attachment',
        'attachment_type_id.in' => 'Invalid attachment type',
        'attachment_type_id.required_with' => 'Attachment type not set',
        'folder.required_if' => 'Attachment not selected',
        'document.required_if' => 'Attachment not selected'



    ];
}   

