<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

class StoreVisitReportField extends Model
{
    protected $table = 'store_visit_report_field';
    protected $fillable = ['field', 'field_alias'];

    public static function getStoreVisitReportFields()
    {
    	$fields = Self::all();
    	$fieldMap = [];
    	foreach ($fields as $field) {
    		$fieldMap[$field->field_alias] = $field->field;
    	}

    	return $fieldMap;
    }
}
