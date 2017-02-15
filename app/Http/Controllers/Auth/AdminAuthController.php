<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Auth\Group;
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
    
    public function getLogin()
    {
        return view('auth.login');
    }

    public function authenticated(Request $request, User $user)
    {
        $group_id = $user->group_id;
        $group = Group::find($group_id)->pluck('name');
        \Log::info($group);
        if($group == $this->groupName){
            return redirect()->intended($this->redirectPath());    
        }
        \Log::info("you're at wrong place");
        

    }
}
