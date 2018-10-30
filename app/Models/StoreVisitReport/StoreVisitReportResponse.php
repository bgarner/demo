<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

class StoreVisitReportResponse extends Model
{

	protected $table = 'store_visit_report_response';
	protected $fillable = ['report_instance_id', 'field_id', 'response'];

    public static function updateResponses($report_id, $request)
    {
    	
    	foreach ($request as $key => $value) {


    		if(StoreVisitReportField::where('field_alias', $key)->first()){
    			$field_id = StoreVisitReportField::where('field_alias', $key)->first()->id;

                $existingResponse = StoreVisitReportResponse::where('report_instance_id', $report_id)
                                            ->where('field_id', $field_id)
                                            ->first();

                if($existingResponse){
                    
                    $existingResponse->update(['response' => $value]);
                    
                }
                else{
                    StoreVisitReportResponse::create([
                        'report_instance_id' => $report_id,
                        'field_id' => $field_id,
                        'response' => $value
                    ]);    
                }
    			
    		}
    	}

    	return;
    	
    }

    public static function getFieldResonseMap($report_id)
    {
    	$reportFields = StoreVisitReportResponse::join('store_visit_report_field', 'store_visit_report_response.field_id', '=', 'store_visit_report_field.id')
    						->where('report_instance_id', $report_id)
    						->select('field_alias', 'response')
    						->get();
    	$fieldResponseMap = [];
    	foreach ($reportFields as $reportField) {
    		$fieldResponseMap[$reportField->field_alias] = $reportField->response;
    	}

    	return $fieldResponseMap;
    }
}
