<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class VideoTarget extends Model
{
    protected $table = 'video_target';
    protected $fillable = ['video_id', 'store_id'];
}
