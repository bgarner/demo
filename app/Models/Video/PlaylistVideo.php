<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;

class PlaylistVideo extends Model
{
    use SoftDeletes;

    protected $table = 'playlist_videos';
    protected $fillable = ['playlist_id', 'video_id'];
    protected $dates = ['deleted_at'];

    public static function getPlaylistVideos($playlistId)
    {
        $playlist_videos = PlaylistVideo::join('videos', 'playlist_videos.video_id', '=', 'videos.id')
        								->where('playlist_id', $playlistId)
        								->where('playlist_videos.deleted_at', '=', null)
        								->select('videos.*')
                                        ->orderBy('playlist_videos.order')
        								->get();

        foreach($playlist_videos as $video){
            $video->likes = number_format($video->likes);
            $video->dislikes = number_format($video->dislikes);
            $video->sinceCreated = Utility::getTimePastSinceDate($video->created_at);
            $video->prettyDateCreated = Utility::prettifyDate($video->created_at);
        }

        return $playlist_videos;


    }
}
