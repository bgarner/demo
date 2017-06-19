<?php

namespace App\Http\Controllers\Locale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class LocaleController extends Controller
{
    public static function setLanguage(Request $request)
    {
        App::setLocale($request->lang);
        $request->session()->put('language', $request->lang);
    }
}
