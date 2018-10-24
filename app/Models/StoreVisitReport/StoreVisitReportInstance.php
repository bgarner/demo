<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StoreVisitReportInstance extends Model
{
    protected $table = 'store_visit_report_instance';
    protected $fillable = ['store_number', 'dm_id', 'is_draft', 'submitted_at'];

    public static function getNewReport()
    {
    	$dm_id = \Auth::user()->id;
    	$newStoreVisitReport = StoreVisitReportInstance::create([
    		'store_number' => '',
    		'dm_id'        => $dm_id,
    		'is_draft'     => 1,
    		'submitted_at' => NULL

    	]);

    	return $newStoreVisitReport;
    }

    public static function saveReport($id, $request)
    {
    	\Log::info($request);
    	$storeVisitReport = StoreVisitReportInstance::find($id);
    	$storeVisitReport->update([
    		'store_number' => $request->store_number,
    		'is_draft' => $request->is_draft
    	]);

    	if(!$request->is_draft){
    		$storeVisitReport->update([
    			'submitted_at' => Carbon::now()->toDateTimeString()
    		]);
    	}

    	StoreVisitReportResponse::updateResponses($id, $request->all());

    }

    public static function getReportById($id)
    {
    	// StoreVisitReportInstance::join('')
    }
}
