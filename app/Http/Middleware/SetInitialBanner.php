<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;


class SetInitialBanner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = Auth::user()->id;
        $default_banner_id = UserBanner::where('user_id', $user_id)->first()->banner_id;

        // if ( $default_banner_id == null ) {
        //     return redirect('/login')->withErrors();
        // }

        $exists = UserSelectedBanner::where('user_id', $user_id)->get();
        if (count($exists) == 0) {

            UserSelectedBanner::create(['user_id' => $user_id, 'selected_banner_id' => $default_banner_id]);
        }

        return $next($request);
    }
}
