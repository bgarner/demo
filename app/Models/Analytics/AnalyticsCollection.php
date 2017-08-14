<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

class AnalyticsCollection extends Model
{
    protected $table = 'analytics_collection';
    protected $fillable = ['resource_id', 'asset_type_id', 'opened_total', 'unopened_total', 'sent_to_total', 'opened', 'unopened', 'sent_to'];
}
