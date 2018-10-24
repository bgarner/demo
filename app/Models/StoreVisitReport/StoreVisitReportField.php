<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;

class StoreVisitReportField extends Model
{
    protected $table = 'store_visit_report_field';
    protected $fillable = ['field', 'field_alias'];
}
