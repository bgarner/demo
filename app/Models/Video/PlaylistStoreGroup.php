<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class PlaylistStoreGroup extends Model
{
    protected $table = 'playlist_store_group';

    protected $fillable = ['playlist_id', 'store_group_id'];
}
