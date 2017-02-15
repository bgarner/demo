<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;

class AdminAuthController extends AuthController
{
    /*
    * Properties | define all the properties here 
    * to overwrite the laravel default properties such as routes.
    */
    protected $redirectTo = '/admin/';
    protected $loginPath = '/admin/login';
    protected $redirectPath = '/admin/';
    protected $redirectAfterLogout = '/admin/login';
    protected $groupName = 'admin';
    protected $alternateLogin = '/manager/login';
    protected $allowedGroups = ['admin', 'users'];
    
    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

}
