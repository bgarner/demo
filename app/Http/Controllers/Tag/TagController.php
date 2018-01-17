<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Utility\Utility;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Video\Video;
use App\Models\Video\Playlist;
use App\Models\Document\Document;
use App\Models\Communication\Communication;

class TagController extends Controller
{
    /**
     * Instantiate a new TagController instance.
     */
    public function __construct()
    {
        //
    }

    public function index($storeno, $tagname, Request $request)
    {
        $tagId = Tag::getTagIdByTagName($tagname);


        if( isset($request['archives']) && $request['archives']){
            $content = ContentTag::getContentByTagIdWithArchive($tagId);
        } else {
            $content = ContentTag::getContentByTagId($tagId);
        }

        $videos = collect();
        $playlists = collect();
        $communications = collect();
        $docs = collect();

        foreach($content as $c){

            switch($c->content_type){

                case "video":
                    $video_item = Video::find($c->content_id);
                    $video_item->since = Utility::getTimePastSinceDate($video_item->updated_at);
                    $video_item->content_type = "video";
                    $videos->push($video_item);
                    break;

                case "playlist":
                    $playlist_item = Playlist::find($c->content_id);
                    $playlist_item->since = Utility::getTimePastSinceDate($playlist_item->updated_at);
                    $playlist_item->content_type = "playlist";
                    $playlists->push($playlist_item);
                    break;

                case "document":
                    $document_item = Document::find($c->content_id);
                    $document_item->modalLink = Utility::getModalLink($document_item->filename, $document_item->title, $document_item->original_extension, $document_item->id, 0);
                    $document_item->since = Utility::getTimePastSinceDate($document_item->updated_at);
                    $document_item->folder = Document::getFolderInfoByDocumentId($document_item->id);
                    $document_item->icon = Utility::getIcon($document_item->original_extension);
                    $document_item->content_type = "document";
                    if(ContentTag::checkContentExpiry($document_item)){
                        $document_item->archived = "true";
                    }
                    $docs->push($document_item);
                    break;

                case "communication":
                    $communication_item = Communication::find($c->content_id);
                    $communication_item->since = Utility::getTimePastSinceDate($communication_item->updated_at);
                    $communication_item->trunc = Utility::truncateHtml($communication_item->body);
                    $communication_item->content_type = "communication";
                    if(ContentTag::checkContentExpiry($communication_item)){
                        $communication_item->archived = "true";
                    }
                    $communications->push($communication_item);
                    break;

            }

        }

        $tagname = str_replace("-", " ", $tagname);
        //dd($communications);
        return view('site.tag.index')
            ->with('tagname', $tagname)
            ->with('archives', $request['archives'])
            ->with('docs', $docs)
            ->with('communications', $communications)
            ->with('videos', $videos)
            ->with('playlists', $playlists);
//            ->with('archives', $request['archives']);

    }
}
