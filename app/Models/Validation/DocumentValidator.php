<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class DocumentValidator extends PortalValidator
{
    protected $rules = [

    	'filename'	=> 'required|mimes:jpeg,bmp,png,pdf,xls,xlsx,xlsm,webm',
    	'folder_id' => 'required|exists:folder_ids,id',
    	'start'		=> 'required|date',
    	'target_stores' =>'required'

    ];


    protected $messages = [];
}
