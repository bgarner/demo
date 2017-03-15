<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Auth\Group\Group;
use App\Models\Auth\User\UserSelectedBanner;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, 
    use ThrottlesLogins;
    /*
    * Properties | define all the properties here 
    * to overwrite the laravel default properties such as routes.
    */



    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    public function getLogout()
    {
        
        $user_id = \Auth::user()->id;

        \Log::info('******************');
        \Log::info('Logout requested');
        \Log::info(Auth::user());
        \Log::info(\Request::getClientIp());

        UserSelectedBanner::where('user_id', $user_id)->delete();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function authenticated(Request $request, User $user)
    {
        $group_id = $user->group_id;
        $group = Group::where('id', $group_id)->first()->name;
        if( in_array( $group, $this->allowedGroups) ){
            return redirect()->intended($this->redirectPath());    
        }
        Auth::logout();
        return redirect( $this->alternateLogin );   

    }


}
