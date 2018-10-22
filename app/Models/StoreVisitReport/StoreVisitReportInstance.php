<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

class StoreVisitReportInstance extends Model
{
    protected $table = 'store_visit_report_instance';
    protected $fillable = ['store_number', 'dm_id', 'is_draft', 'submitted_at'];

    public static function saveReport($request)
    {
    	\Log::info($request->all());
    }
}
