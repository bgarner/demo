<?php
namespace App\Models\Document;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Week;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use App\Models\Document\DocumentPackage;
use Carbon\Carbon;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\UserSelectedBanner;
use DB;
use App\Models\Alert\Alert;
use App\Models\Utility\Utility;
use App\Models\Dashboard\Quicklinks;
use App\Models\Document\DocumentTarget;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\DocumentValidator;
use App\Models\Feature\FeatureDocument;
use App\Models\Communication\CommunicationDocument;
use App\Models\UrgentNotice\UrgentNoticeAttachment;


class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';
    protected $fillable = array('upload_package_id', 'original_filename','original_extension', 'filename', 'title', 'description', 'start', 'end', 'banner_id');
    protected $dates = ['deleted_at'];

    public static function validateCreateDocument($request)
    {
        \Log::info($request->all());
        $validateThis = [
            'folder_id' => intval($request['folder_id']),
            'filename'  => $request->file('document'),
            'start'     => $request['start'],
            'target_stores' => explode(',', $request['stores'])
        ];


        \Log::info($validateThis);

        $v = new DocumentValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;

    }

    public static function validateEditDocument($request)
    {

    }


    public static function getDocuments($global_folder_id, $forStore=null, $storeNumber=null)

    {

        if (isset($global_folder_id)) {

            $global_folder_details = \DB::table('folder_ids')->where('id', $global_folder_id )->first();

            $folder_type = $global_folder_details->folder_type;
            $folder_id = $global_folder_details->folder_id;

            $now = Carbon::now()->toDatetimeString();

            if ($forStore) {
                $files = \DB::table('file_folder')
                            ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                            ->join('document_target', 'document_target.document_id' , '=', 'documents.id')
                            ->where('file_folder.folder_id', '=', $global_folder_id)
                            ->where('documents.start', '<=', $now )
                            ->where(function($query) use ($now) {
                                $query->where('documents.end', '>=', $now)
                                    ->orWhere('documents.end', '=', '0000-00-00 00:00:00' );
                            })
                            ->where('documents.deleted_at', '=', null)
                            ->where('document_target.deleted_at', '=', null)
                            ->where('document_target.store_id', strval($storeNumber))
                            ->select('documents.*')
                            ->get();

            }
            else{
                $files = \DB::table('file_folder')
                            ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                            ->where('file_folder.folder_id', '=', $global_folder_id)
                            ->where('documents.deleted_at', '=', null)
                            ->select('documents.*')
                            ->get();
            }




            if (count($files) > 0) {
                foreach ($files as $file) {
                    $file->link = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 0);
                    $file->link_with_icon = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 1);
                    $file->icon = Utility::getIcon($file->original_extension);
                    $file->prettyDateCreated = Utility::prettifyDate($file->created_at);
                    $file->prettyDateUpdated = Utility::prettifyDate($file->updated_at);
                    $file->prettyDateStart = Utility::prettifyDate($file->start);
                    $file->prettyDateEnd = Utility::prettifyDate($file->end);

                    $file->is_alert = '';
                    if (Alert::where('document_id', $file->id)->first()) {
                        $file->is_alert = Utility::getAlertIcon();
                    }

                }

                return $files;
            }
            else{
                return [];
            }

        }

        return [];

    }

    public static function storeDocument($request)
    {

        $validate = Document::validateCreateDocument($request);

        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }

        $metadata = Document::getDocumentMetaData($request->file('document'));

        $directory = public_path() . '/files';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        $banner = UserSelectedBanner::getBanner();

        if ($upload_success) {
            $documentdetails = array(
                'original_filename' => $metadata["originalName"],
                'filename'          => $filename,
                'original_extension'=> $metadata["originalExtension"],
                'upload_package_id' => $request->get('upload_package_id'),
                'title'             => preg_replace('/\.'.preg_quote($metadata["originalExtension"]).'/', '', $metadata["originalName"]),
                'description'       => "no description",
                'banner_id'         => $banner->id,
                'start'             => $request->start,
                'end'               => $request->end
            );

            $document = Document::create($documentdetails);
            $document->save();
            $lastInsertedId= $document->id;

            //update file-folder table
            $isWeekFolder = $request->get('isWeekFolder');
            $folder_type = "folder";
            if ($isWeekFolder == "true") {
                $folder_type = "week";
            }

            $global_folder_id = $request->get('folder_id');

            $documentfolderdetails = array(
                'document_id' => $lastInsertedId,
                'folder_id' => $global_folder_id
            );

            $documentfolder = FileFolder::create($documentfolderdetails);


            //update folder timestamp
            Folder::updateTimestamp($global_folder_id, $document->created_at);

            $documentfolder->save();

            //update document target
            Document::updateDocumentTarget($request, $document);

        }

        return ;
    }

    public static function getDocumentMetaData($file)
    {

        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = preg_replace('/[^A-Za-z0-9\-\s+\.]/', '', $originalName);
        $modifiedName = preg_replace('/\s+/', '_', $modifiedName);
        $modifiedName = preg_replace('/(\.)+/', '_', $modifiedName);

        $response = [];
        $response["originalName"] = $originalName;
        $response["modifiedName"] = $modifiedName;
        $response["originalExtension"] = $extension;

        return $response;
    }

    public static function getDocumentById($id)
    {
        $document =  Document::where('id', $id)->first();
        if ($document) {
            return $document;
        }
        return [];
    }

    public static function deleteDocument($id)
    {

        //delete from folder
        FileFolder::where('document_id', $id)->delete();

        //delete from package
        DocumentPackage::where('document_id', $id)->delete();

        //delete from feature
        FeatureDocument::where('document_id', $id)->delete();

        //delete from communication
        CommunicationDocument::where('document_id', $id)->delete();

        //delete from Urgent Notice
        UrgentNoticeAttachment::deleteAttachment($id, 'Document');

        //delete from quicklink
        $quicklink = Quicklinks::where('url', $id)->where('type', 2)->first();
        if ($quicklink) {
            $quicklink->delete();
        }

        //delete alert
        Alert::deleteAlert($id);

        $document = Document::find($id);
        $document->delete();

        return;
    }

    public static function updateMetaData(Request $request, $id=null)
    {

        if (!isset($id)) {
            $id = $request->get('file_id');
        }

        $tags = $request->get('tags');
        if ($tags != null) {
            Document::updateTags($id, $tags);
        }

        $title          = $request->get('title');
        $description    = $request->get('description');
        $start          = $request->get('start');
        $end            = $request->get('end');

        $metadata = array(
            'title'       => $title,
            'description' => $description,
            'start'       => $start,
            'end'         => $end
        );

        $document = Document::find($id);
        $document->update($metadata);

        $global_parent_folder_id = FileFolder::where('document_id', $id)->first()->folder_id;
        Folder::updateTimestamp($global_parent_folder_id, $document->updated_at );

    }

    public static function updateDocument($request, $id) {

        $document       = Document::find($id);
        $title          = $request->get('title');
        $description    = $request->get('description');
        $doc_start      = $request->get('document_start');
        $doc_end        = $request->get('document_end');

        $document['title']  = $title;
        $document['description'] = $description;
        $document['start']  = $doc_start;
        $document['end']  = $doc_end;

        $document->save();

        Document::updateDocumentTarget($request, $document);

        $is_alert = $request->get('is_alert');
        if( $is_alert == 1) {
            Alert::markDocumentAsAlert($request, $id);
        }
        else if ($is_alert == 0) {
            Alert::deleteAlert($document->id);
        }

        return $document;

    }

    public static function getRecentDocuments($banner_id, $days)
    {
        $fromDate =  Carbon::today()->subDays($days);
        $documents = Document::where('start', '>=', $fromDate)
                            ->where('banner_id', $banner_id)
                            ->orderBy('start','desc')
                            ->get();

        foreach ($documents as $document) {

            $global_folder_id = FileFolder::where('document_id',$document->id)->first()->folder_id;

            $global_folder_details =  \DB::table('folder_ids')->where('id', $global_folder_id)->first();
            $folder_id = $global_folder_details->folder_id;
            $folder_type = $global_folder_details->folder_type;


            if ($folder_type == 'folder') {
                $folder_details = Folder::where('id', $folder_id)->get();
            }
            else{
                $folder_details  = Week::where('id', $folder_id)->get();
            }

            $document["folder_details"] = $folder_details;
            unset($folder_id);
            unset($folder_details);

        }
        return $documents;
    }

    public static function getArchivedDocumentsByStoreNumber($global_folder_id, $storeNumber)
    {

        $now = Carbon::now()->toDatetimeString();

        $files = \DB::table('file_folder')
                    ->join('documents', 'file_folder.document_id', '=', 'documents.id')
                    ->join('document_target', 'document_target.document_id' , '=', 'documents.id')
                    ->where('file_folder.folder_id', '=', $global_folder_id)
                    ->where('documents.end', '<=', $now)
                    ->where('documents.end', '!=', '0000-00-00 00:00:00')
                    ->where('document_target.store_id', strval($storeNumber))
                    ->where('documents.deleted_at', '=', null)
                    ->where('document_target.deleted_at', '=', null)
                    ->select('documents.*')

                    ->get();

        if (count($files) > 0) {
            foreach ($files as $file) {
                $file->archived = true;
                $file->link = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 0);
                $file->link_with_icon = Utility::getModalLink($file->filename, $file->title, $file->original_extension, $file->id, 1);
                $file->icon = Utility::getIcon($file->original_extension);
                $file->prettyDateCreated = Utility::prettifyDate($file->created_at);
                $file->prettyDateUpdated = Utility::prettifyDate($file->updated_at);
                $file->prettyDateStart = Utility::prettifyDate($file->start);
                $file->prettyDateEnd = Utility::prettifyDate($file->end);

                $file->is_alert = '';
                if (Alert::where('document_id', $file->id)->first()) {
                    $file->is_alert = Utility::getAlertIcon();
                }

            }
            return $files;
        }
        else{
            return [];
        }
    }

    public static function createDocumentThumbnail($filename)
    {

        $im = new \Imagick();
        $im->readimage(public_path().'/files/'. $filename.'[0]');
        // $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);
        $im->resizeImage(600,700, 0, 2, true);
        $im->setImageFormat('jpeg');
        $im->writeImage(public_path().'/images/documents/thumb/'.$filename.'.jpg');
        $im->clear();
        $im->destroy();

    }

    public static function getFolderPathForDocument($id)
    {

        $parent_global_id = FileFolder::where('document_id', $id)->first()->folder_id;
        $parent = \DB::table('folder_ids')->where('id', $parent_global_id)->first();
        $path = [];
        array_push($path, $parent);
        $finalPath = "";
        while (!empty($path)) {
            $currentFolder = array_pop($path);

            if(isset($currentFolder->folder_type)) {
                if ($currentFolder->folder_type ==  'week') {
                $weekFolder = Week::where('id', $currentFolder->folder_id)->first();
                $parent_id = $weekFolder->parent_id;
                $parent = \DB::table('folder_ids')->where('id', $parent_id)->first();
                $finalPath = "week" . $weekFolder->week_number . "/" . $finalPath;
                array_push($path, $parent);

            }
            else if ($currentFolder->folder_type == 'folder') {
                $folder_struct = FolderStructure::where('child', $currentFolder->folder_id)->first();
                if( $folder_struct) {

                    $parent_id = $folder_struct->parent;
                    $parent = $parent = \DB::table('folder_ids')->where('folder_id', $parent_id)->where('folder_type', 'folder')->first();
                    //folder_id would be replace with id when folder_struct gets updated to store global_folder_id
                    $finalPath = Folder::where('id', $currentFolder->folder_id)->first()->name ."/". $finalPath;
                    array_push($path, $parent);
                    continue;
                }
                else{
                    $parent = Folder::where('id', $currentFolder->folder_id)->first();
                    $finalPath = $parent->name ."/".$finalPath;
                    break;

                }
            }
            }

        }

        return ($finalPath);
    }

    public static function updateTags($id, $tags)
    {
        ContentTag::where('content_type', 'document')->where('content_id', $id)->delete();
        foreach ($tags as $tag) {
            ContentTag::create([
               'content_type'   => 'document',
               'content_id'     => $id,
               'tag_id'         => $tag
            ]);
        }

        return;
    }

    public static function getFolderInfoByDocumentId($id)
    {
        $folder = FileFolder::where('document_id', $id)->first();
        $globalFolderId = $folder->folder_id;

        $folderInfo = DB::table('folder_ids')
                    ->join('folders', 'folder_ids.folder_id', '=', 'folders.id')
                    ->where('folder_ids.id', $globalFolderId)
                    ->first();

        $folderInfo->global_folder_id = $globalFolderId;

        return $folderInfo;

    }

    public static function updateDocumentTarget(Request $request, $document)
    {
         if ($request['stores'] != '') {
            DocumentTarget::where('document_id', $document->id)->delete();
            $target_stores = $request['stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['stores'] );
            }

            foreach ($target_stores as $key=>$store) {
                DocumentTarget::insert([
                    'document_id' => $document->id,
                    'store_id' => $store
                    ]);
            }
        }
            return;
    }
}
