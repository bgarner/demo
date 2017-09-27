<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class VideoStoreGroup extends Model
{
    protected $table = 'video_store_group';

    protected $fillable = ['video_id', 'store_group_id'];
}
