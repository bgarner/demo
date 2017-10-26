<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureEventType extends Model
{
    protected $table = 'feature_event_type';
    protected $fillable = ['feature_id', 'event_type_id'];
}
