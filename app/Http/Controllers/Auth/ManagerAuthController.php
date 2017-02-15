<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Auth\Group;
use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;
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
    protected $groupName = 'manager';


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('manager.login');
    }
    

    public function authenticated(Request $request, User $user)
    {
        $group_id = $user->group_id;
        $group = Group::find($group_id)->pluck('name');
        if($group == $this->groupName){
            return redirect()->intended($this->redirectPath());    
        }
        \Log::info("you're at wrong place");
        

    }
}
