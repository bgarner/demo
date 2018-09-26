<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;

class ManagerLoginReportController extends Controller
{
    public function index()
    {
     	$users = User::getUsersByGroupId(2);
        return view('manager.report.managerlogin.index')
        		->with('users', $users);
            // ->with('toDate', $toDate)
            // ->with('sinceLastWeek', $sinceLastWeek)
            // ->with('lastWeek', $lastWeek);
    }
}
