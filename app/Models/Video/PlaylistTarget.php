<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class PlaylistTarget extends Model
{
    protected $table = 'playlist_target';

    protected $fillable = ['playlist_id', 'store_id'];
}
