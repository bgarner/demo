<?php

namespace App\Http\Controllers\Surveys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Surveys\Survey;


class SurveyController extends Controller
{
    public static function index()
    {
        $storeNumber = RequestFacade::segment(1);
        $surveys = Survey::getSurveysByStore($storeNumber);
        return view('site.surveys.index');
    }

    public static function show($id)
    {

    }
}
