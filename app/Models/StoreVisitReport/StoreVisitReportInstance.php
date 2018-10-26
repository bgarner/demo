<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StoreVisitReportInstance extends Model
{
    protected $table = 'store_visit_report_instance';
    protected $fillable = ['store_number', 'dm_id', 'is_draft', 'submitted_at'];

    public static function saveReport($request)
    {
    	$dm_id = \Auth::user()->id;
    	$newStoreVisitReport = StoreVisitReportInstance::create([
    		'store_number' => $request->store_number,
    		'dm_id'        => $dm_id,
    		'is_draft'     => $request->is_draft,
    	]);

    	if(!$request->is_draft){
    		$storeVisitReport->update([
    			'submitted_at' => Carbon::now()->toDateTimeString()
    		]);
    	}

    	StoreVisitReportResponse::updateResponses($newStoreVisitReport->id, $request->all());
    	return $newStoreVisitReport;
    }

    public static function updateReport($id, $request)
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
    	return;

    }

    public static function getReportById($id)
    {
    	$report = StoreVisitReportInstance::find($id);
    	$report->fields = StoreVisitReportResponse::getFieldResonseMap($id);

    	return $report;
    	
    }
}
