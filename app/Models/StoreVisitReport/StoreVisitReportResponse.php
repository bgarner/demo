<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

class StoreVisitReportResponse extends Model
{

	protected $table = 'store_visit_report_response';
	protected $fillable = ['report_instance_id', 'field_id', 'response'];

    public static function updateResponses($report_id, $request)
    {
    	
    }
}
