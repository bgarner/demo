<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\Component\Component;
use App\Models\Auth\Role\RoleComponent;
use App\Models\Auth\User\UserRole;

class RoleComponentAccess
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

        $componentName = config('app.controllerComponentMap')[$controller];
        $component_id = Component::getComponentIdByComponentName($componentName);

        $role_ids = RoleComponent::getRoleListByComponentId($component_id);
        $role_id = UserRole::where('user_id', $this->user->id)->first()->role_id;

        if(! in_array($role_id, $role_ids)) {

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/home');
            }
        }

        return $next($request);
    }
}
