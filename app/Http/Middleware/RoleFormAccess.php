<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Models\Form\Form;
use App\Models\Form\FormRoleMap;
use App\Models\Auth\User\UserRole;

class RoleFormAccess
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $user;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controllerAction = $request->route()->getActionName();
        $controller = preg_split('/@/',  $controllerAction)[0];
        $formNameAndVersion = config('app.controllerFormMap')[$controller];

        if($formNameAndVersion){
            $formName = preg_split('/_v_/',  $formNameAndVersion)[0];
            $formVersion = preg_split('/_v_/',  $formNameAndVersion)[1];

            $form_id = Form::getFormIdByFormNameAndVersion($formName, $formVersion);

            $role_ids = FormRoleMap::getRoleListByFormId($form_id);
            $role_id = UserRole::where('user_id', $this->user->id)->first()->role_id;

            if(! in_array($role_id, $role_ids)) {

                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->guest('admin/formlist');
                    \Log::info('not authorized : FormRoleAccess');
                }
            }    
        }
        

        return $next($request);
    }
}
