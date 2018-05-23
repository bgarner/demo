<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UserValidator extends PortalValidator
{
    protected $rules = [
    	'firstname' => 'required',
    	'lastname'	=> 'required',
    	'username'	=> 'sometimes|required|string|unique:users,username',
    	'group'		=> 'required|exists:groups,id',
    	'banners'	=> 'required|exists:banners,id'

    ];

    protected $messages = [

    ];
}