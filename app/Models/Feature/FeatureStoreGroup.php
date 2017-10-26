<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureStoreGroup extends Model
{
    protected $table = 'feature_store_group';
    protected $fillable = ['feature_id', 'store_group_id'];
}
