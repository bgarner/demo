<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoTag extends Model
{
    use SoftDeletes;

    protected $table = 'video_tags';
    protected $fillable = ['video_id', 'tag_id'];
    protected $dates = ['deleted_at'];
}
