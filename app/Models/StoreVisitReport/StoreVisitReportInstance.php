<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

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

    public static function saveReport($request)
    {
    	\Log::info("save Report Instance");
    	\Log::info("save Report instance Responses");
    }

    public static function getReportById($id)
    {
    	// StoreVisitReportInstance::join('')
    }
}
