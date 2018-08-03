<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAsUserController extends Controller
{

    public function index(Request $request)
    {
        \Auth::loginUsingId($request->id);
        return redirect('/login');
    }
}