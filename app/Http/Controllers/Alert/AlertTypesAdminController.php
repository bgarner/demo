<?php

namespace App\Http\Controllers\Alert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alert\AlertType;

class AlertTypesAdminController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alerttypes = AlertType::getAllAlertTypes();
        return view('admin.alerttypes.index')
            ->with('alerttypes', $alerttypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.alerttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AlertType::createAlertType($request);
        return redirect()->action('Alert\AlertTypesAdminController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $alertType = AlertType::find($id);
        return view('admin.alerttypes.edit')->with('alertType', $alertType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        AlertType::updateAlertType($id, $request);
        return redirect()->action('Alert\AlertTypesAdminController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AlertType::find($id)->delete();
    }
}
