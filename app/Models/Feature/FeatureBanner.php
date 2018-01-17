<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureBanner extends Model
{
    protected $table = 'feature_banner';
    protected $fillable = ['feature_id', 'banner_id'];
}
