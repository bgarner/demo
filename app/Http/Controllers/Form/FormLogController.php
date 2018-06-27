<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormActivityLog;
use App\Models\Form\FormResolution;

class FormLogController extends Controller
{
    public function show($id)
    {
    	$log = FormActivityLog::getFormInstanceLog($id);
    	return view('admin.form.partials.log')
    			->with('log', $log);
    }
}
