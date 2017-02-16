<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Auth\User\UserSelectedBanner;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;

class ManagerAuthController extends AuthController
{  
    /*
    * Properties | define all the properties here 
    * to overwrite the laravel default properties such as routes.
    */
    protected $redirectTo = '/manager';
    protected $loginPath = '/manager/login';
    protected $redirectPath = '/manager';
    protected $redirectAfterLogout = '/manager/login';
    protected $alternateLogin = '/admin/home';
    protected $allowedGroups = ['manager'];

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('manager.login');
    }
    
}
