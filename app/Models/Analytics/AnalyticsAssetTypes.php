<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

class AnalyticsAssetTypes extends Model
{
    protected $table = 'analytics_asset_types';
    protected $fillable = ['type'];
}
