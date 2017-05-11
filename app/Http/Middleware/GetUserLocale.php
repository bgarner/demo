<?php

namespace App\Http\Middleware;

use Closure, Session, Config, App;

class GetUserLocale
{
    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en','fr'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $sessionLang = session('language');

        if($sessionLang){
            App::setLocale($sessionLang);
            return $next($request);
        }

        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        session(['language' => $lang]);
        App::setLocale($lang);

        return $next($request);
        //$language = Session::get('language', Config::get('app.locale'));
    }
}
