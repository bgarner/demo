<?php

namespace App\Models\Auth\User;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Profile\Profile;
use App\Models\Auth\User\UserBanner;
use App\Models\Validation\UserValidator;
use App\Models\Auth\User\UserRole;
use App\Models\Auth\User\UserResource;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'group_id', 'fglposition', 'username'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // public function activateAccount($code)
    // {
    //     $user = User::where('activation_code', '=', $code)->first();
    //     $user->active = 1;
    //     $user->activation_code = '';
    //     if($user->save()) {
    //     \Auth::login($user);
    //     }
    //     return $user;
    // }
    // public function approveAccount($code)
    // {
    //     $user = User::where('approval_code', '=', $code)->first();
    //     $user->approved = 1;
    //     $approvalCode = $user->approval_code;
    //     $user->approval_code = '';

    //     if($user->save()) {
            
    //         $store = substr($approvalCode, 60);
    //         $profile = Profile::initiateProfile($store, $user);  

    //     }
    //     return $user;
    // }

    public static function getAdminUsers()
    {
        $users = User::whereIn('group_id', [1,2,3])->get();
        foreach ($users as $user) {
            $banners = UserBanner::where('user_id', $user->id)->get();
            $user["banners"] = $banners;
        }
        return $users;
    }
    
    public static function createAdminUser($request)
    {
        $validateThis = [
            'firstname' => $request['firstname'],
            'lastname'  => $request['lastname'],
            'group'     => $request['group'],
            'banners'   => $request['banners'],
            'username'  => $request['username']

        ];      

        $v = new UserValidator();
        $validate = $v->validate($validateThis);
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }

        \Log::info($request['jobtitle']);
        $user = User::create([
            'firstname'   => $request['firstname'],
            'lastname'    => $request['lastname'],
            'fglposition' => $request['jobtitle'],
            'username'    => $request['username'],
            'group_id'    => intval($request['group'])
        ]);



        $banners = $request['banners'];
        foreach ($banners as $banner) {
            UserBanner::create([
                'user_id' => $user->id,
                'banner_id' => $banner
            ]);
        }

        if(isset($request["resource"])){
            UserResource::create([
                    'user_id' => $user->id,
                    'resource_id' => $request["resource"]
                ]);
        }

        if(isset($request["role"])){
            UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $request["role"]
                ]);
        }

        if(isset($request['business_unit']) && ! is_null($request['business_unit'])){
            foreach ($request->business_unit as $bu) {
                FormUserBusinessUnitMap::create([
                    'user_id' => $user->id,
                    'business_unit_id' => $bu
                ]);
            }
            
        }

        return $user;

    }

    public static function updateAdminUser($id, $request)
    {

        
        \Log::info('******************');
        \Log::info('User profile update requested');
        \Log::info( $request['firstname'] . ' ' . $request['lastname'] . ' was updated.');
        \Log::info('IP address : ' . $request->server('HTTP_USER_AGENT'));
        \Log::info(\Request::getClientIp());

        $validateThis = [
            'firstname'   => $request['firstname'],
            'lastname'    => $request['lastname'],
            'group'       => $request['group'],
            'banners'     => $request['banners']
        ];
        
        $v = new UserValidator;

        $validate = $v->validate($validateThis);
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);        
            return json_encode($validate);
        }

        $user = User::find($id);

        $user['firstname']   = $request['firstname'];
        $user['lastname']    = $request['lastname'];
        $user['group_id']    = intval($request['group']);
        $user['fglposition'] = $request['jobtitle'];

        $user->save();

        UserRole::updateUserRole($user->id, ($request['role']));
        UserResource::updateUserResource($user->id, ($request['resource']));
        UserBanner::updateAdminBanner($id, $request['banners']);
        FormUserBusinessUnitMap::updateBusinessUnit($user->id,($request['business_unit']));
        return $user;

    }

    public static function getUsersByGroupId($group_id)
    {
        return Self::where('group_id', $group_id)->get();
    }

    public static function getUsersByBusinessUnitAndRoles($roles, $businessUnits)
    {
        return User::join('user_role', 'users.id' , '=', 'user_role.user_id')
                    ->join('roles', 'user_role.role_id', '=', 'roles.id')
                    ->join('form_business_unit_user', 'users.id', '=', 'form_business_unit_user.user_id')
                    ->join('form_business_unit_types', 'form_business_unit_user.business_unit_id', '=', 'form_business_unit_types.id' )
                    ->where('users.group_id', 3)
                    ->whereIn('roles.id', $roles)
                    ->whereIn('form_business_unit_user.business_unit_id', $businessUnits)
                    ->select('users.*', 'roles.role_name', 'roles.id as role_id', 'form_business_unit_types.business_unit' )
                    ->get();
    }

    public static function getUserDetailsByUserList($userList)
    {
        return User::join('user_role', 'users.id' , '=', 'user_role.user_id')
                    ->join('roles', 'user_role.role_id', '=', 'roles.id')
                    ->join('form_business_unit_user', 'users.id', '=', 'form_business_unit_user.user_id')
                    ->join('form_business_unit_types', 'form_business_unit_user.business_unit_id', '=', 'form_business_unit_types.id' )
                    ->where('users.group_id', 3)
                    ->whereIn('users.id', $userList)
                    ->select('users.*', 'roles.role_name', 'roles.id as role_id', 'form_business_unit_types.business_unit' )
                    ->get();   
    }

}
