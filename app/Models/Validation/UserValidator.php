<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class UserValidator extends PortalValidator
{
    protected $rules = [
    	'firstname' => 'required',
    	'lastname'	=> 'required',
    	'email'		=> 'sometimes|required|email|unique:users,email',
    	'group'		=> 'required|exists:groups,id',
    	'banners'	=> 'required|exists:banners,id',
    	'password'	=> 'sometimes|required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/|confirmed',
    	'password_confirmation' => 'required_with:password'

    ];

    protected $messages = [

    	'password.regex' => 'Password must contain all characteristics, namely, UPPER case(A-Z), lower case (a-z), Numbers (0-9) or symbols (!@#$%^&* etc)'

    ];
}