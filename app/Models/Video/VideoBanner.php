<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class VideoBanner extends Model
{
    protected $table = 'video_banner';
    protected $fillable = ['video_id', 'banner_id'];
}
