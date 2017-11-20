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

    public static function updatePlaylistVideos($id, $request)
    {
        $remove_videos = $request["remove_videos"];
         if (isset($remove_videos)) {
            foreach ($remove_videos as $video) {
                PlaylistVideo::where('playlist_id', $id)->where('video_id', intval($video))->delete();
            }
         }

         $add_videos = $request["playlist_videos"];
         if (isset($add_videos)) {
            foreach ($add_videos as $video) {

                    $video_exists = PlaylistVideo::where('playlist_id', $id)
                                                    ->where('video_id', $video)
                                                    ->where('deleted_at', null)
                                                    ->first();
                if( ! $video_exists) {

                    PlaylistVideo::create([
                        'playlist_id'   => $id,
                        'video_id'      => $video
                    ]);
                }


            }
         }
         return;
    }

    public static function fomatPlaylistVideos($videos)
    {
        $playlistVideos = [];
        foreach ($videos as $video) {
            $playlistVideo = [];
            $playlistVideo['id'] = $video->id;
            $playlistVideo['name'] = $video->title;
            $playlistVideo['description'] = $video->description;
            $playlistVideo['sources'] = [ [ 'src' => "/video/".$video->filename , 'type' => "video/".$video->original_extension ] ];
            $playlistVideo['thumbnail'] =[ ['src' => "/video/thumbs/" . $video->thumbnail] ];
            $playlistVideo['views'] = $video->views;
            $playlistVideo['sinceCreated'] = $video->sinceCreated;
            $playlistVideo['prettyDateCreated'] = $video->prettyDateCreated;

            array_push($playlistVideos, $playlistVideo);
            unset($playlistVideo);

        }
        return json_encode($playlistVideos);
    }
}
