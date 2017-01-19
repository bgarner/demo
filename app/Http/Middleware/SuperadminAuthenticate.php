<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Auth\Component;
use App\Models\Auth\GroupComponent;

class SuperadminAuthenticate
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
        $this->user = \Auth::user();
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
        
        // $controllerComponentMap = config('app.controllerComponentMap');
        $componentName = config('app.controllerComponentMap')[$controller];
        $component_id = Component::getComponentIdByComponentName($componentName);

        $group_ids = GroupComponent::getGroupListByComponentId($component_id);

        if(! in_array($this->user->group_id, $group_ids)) {

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/home');
            }
        }
        
        return $next($request);
    }
}
