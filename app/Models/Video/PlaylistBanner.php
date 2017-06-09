<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class PlaylistBanner extends Model
{
    protected $table = 'playlist_banner';

    protected $fillable = ['playlist_id', 'banner_id'];
}
