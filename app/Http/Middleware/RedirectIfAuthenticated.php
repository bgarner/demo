<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\Group\Group;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //Auth::logout();
        if (Auth::guard($guard)->check()) {
            $group_id = Auth::user()->group_id;
            $group = Group::where('id', $group_id)->first()->name;
            return redirect("/". strtolower($group));
        }

        return $next($request);
    }
}
