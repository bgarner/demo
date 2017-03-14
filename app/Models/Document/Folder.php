<?php

namespace App\Models\Document;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Document\FolderStructure;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use Carbon\Carbon;
use App\Models\UserSelectedBanner;
use DB;
use App\Models\Dashboard\Quicklinks;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\GlobalFolder;
use App\Models\Validation\FolderValidator;
use App\Models\Document\FolderPackage;
use App\Models\UrgentNotice\UrgentNoticeAttachment;

class Folder extends Model
{
    use SoftDeletes;
    protected $table = 'folders';
    protected $fillable = array('name' , 'is_child', 'has_weeks', 'week_window_size', 'banner_id', 'has_child');
    protected $dates = ['deleted_at'];

    public static function validateCreateFolder($request)
    {
        $validateThis = [

            'parent' => $request['parent'],
            'name'  => $request['name']
        ];

        $v = new FolderValidator();
        return $v->validate($validateThis);
    }

    public static function validateEditFolder($folderName)
    {
         $validateThis = [
            'name'  => $folderName
        ];

        $v = new FolderValidator();
        return $v->validate($validateThis);
    }


    public static function getFolders()
    {
    	$folders = Folder::all();
        return $folders;
    }

    public static function getFolderName($id)
    {
    	$folder = Folder::find($id);
    	return $folder->name;
    }

    public static function storeFolder(Request $request)
    {
        $validate = Folder::validateCreateFolder($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }


        $parent = $request['parent'];
        $is_child = 0;

        if($parent != ""){
            $is_child = 1;
        }

        $folder = Folder::create([
                'name' => $request['name'],
                'is_child' => $is_child,
                'banner_id'=>$request['banner_id']
        ]);
        \DB::table('folder_ids')->insert([
            'folder_id'    => $folder->id,
            'folder_type'  => 'folder' 
        ]);

        if ($parent != "") {
            $parent_id = \DB::table('folder_ids')->find($parent)->folder_id;
             FolderStructure::create([
                'parent' => intval($parent_id),
                'child'  => $folder->id
            ]);
        }
            
        return $folder;
    }

    public static function deleteFolder($id, Request $request)
    {
        
        $banner_id = $request['banner_id'];

        $files = FileFolder::where('folder_id', $id)->get();

        if (count($files)>0) {
            foreach ($files as $file) {
                Document::where('id', $file->document_id)->delete();
                // unlink(public_path()."/files/".$file->filename);
            }  
            FileFolder::where('folder_id', $id)->delete();
        }

        $folder_id = GlobalFolder::find($id)->folder_id;
        $parentChildStructure = FolderStructure::where('child', $folder_id)->first();
        if (isset($parentChildStructure)) {
            
            $parent = $parentChildStructure->parent;
            
            $children = FolderStructure::where('parent', $parent)->get();

            if (count($children) == 1) {
                $parent = Folder::where('id', $parent)->first();
                $parent["has_child"] = 0;
                $parent->save();
                $parentChildStructure->delete();
            }
            else if (count($children) > 1) {
                $parentChildStructure->delete();
            }

        }
        
        $childFolders = FolderStructure::where('parent', $folder_id)->get();
        if(count($childFolders)>0)
        {
            foreach ($childFolders as $childFolder) {
                $childFolderId = GlobalFolder::where('folder_id', $childFolder->child)->where('folder_type', 'folder')->first()->id;
                Folder::deleteFolder($childFolderId, $request);
            }
            
        }
        
        $folder = Folder::find($folder_id)->delete();  

        GlobalFolder::where('folder_id', $folder_id)->where('folder_type', 'folder')->delete();

        
        //delete from packages
        FolderPackage::where('folder_id', $id)->delete();

        //delete from urgent notices
        UrgentNoticeAttachment::deleteAttachment($id, 'Folder');

        //delete from Quicklink
        $quicklink = Quicklinks::where('url', $id)->where('type', 1)->first();
        if ($quicklink) {
            $quicklink->delete();
        }

        return;
        
    }


    //this function is called for /admin/folder/{id}/edit
    public static function getFolderDetails($global_folder_id)
    {
        $global_folder = \DB::table('folder_ids')->where('id', $global_folder_id)->first();

        $folder = Folder::find($global_folder->folder_id);
        
        $params = [];
        if ($folder->has_child == 1) {

            
            if ($folder->has_weeks == 1) {
                $params = ["param_name" => "has_weeks", "param_value" => true];
            }
            else{
                $child_folders = [];
                $children = FolderStructure::where('parent', $folder->id)->get();
                foreach ($children as $child) {
                    $child_folder = Folder::find($child->child);
                    $child_folder["global_folder_id"] = \DB::table('folder_ids')->where('folder_id', $child_folder->id)->where('folder_type', 'folder')->first()->id;
                    array_push($child_folders, $child_folder);
                }
                $params = [ "param_name"=>"has_children", "param_value"=>$child_folders];
            }
            
        }
        else {
            $documents = FileFolder::where('folder_id', $folder->id)->get();
            if (count($documents) >0) {
                $params = ["param_name" =>"has_documents", "param_value" => true];
            } 
        }
        return ( $params );
        
    }


    public static function getFolderDescription($global_folder_id)
    {
        $global_folder_details = \DB::table('folder_ids')->where('id', $global_folder_id )->first();                                                            
        $folder_type = $global_folder_details->folder_type;
        $folder_id = $global_folder_details->folder_id;
        $folderTree = Folder::getFolderChildrenTree($global_folder_id);
        $allDocumentsInFolder = Folder::getAllDocumentsInFolderTree($folderTree);
        $allDocumentsInFolderCount = count($allDocumentsInFolder);
        unset($folderTree[$global_folder_id]); //removing the root folder to get accurate count of child folders 
        $allChildFoldersCount = count($folderTree);

        if ($folder_type == "week") {
            
            $week = Week::where('id', $folder_id)->first();
            $week->global_folder_id = $global_folder_id;
            $week->folder_path = Folder::getFolderPath($global_folder_id);
            $week->type = "week";
            return $week;

        }
        if ($folder_type == "folder") {
            
            $folder = Folder::where('id', $folder_id)->first();
            $folder->global_folder_id = $global_folder_id;
            $folder->folder_path = Folder::getFolderPath($global_folder_id);
            $folder->folder_children = Folder::getFolderChildren($global_folder_id);
            $folder->type = "folder";
            $folder->allChildFolderCount = $allChildFoldersCount;
            $folder->allDocumentsInFolderCount = $allDocumentsInFolderCount;
            return $folder;
        }

    }

    public static function editFolderDetails($params)
    {
        $validate = Folder::validateEditFolder($params['name']);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }
        $folder = Folder::find($params["id"]);

        $update = [];
        $update ["name"] = $params["name"] ;
        
        /** deprecated 
        //add child
        if (isset($params["children"])) {
            $update["has_child"] = 1;
            Folder::createChildren($params["children"], $folder);
        }

        //add weeks
        elseif (isset($params["weekWindowSize"])) {
            $update = [
                'has_weeks' => 1,
                'week_window_size' => $params["weekWindowSize"],
                'has_child' => 1                
            ];
        }

        //remove weeks
        elseif (isset($params["removeWeeks"])) {
            Folder::removeWeeks($params["id"]);
            $update = [
                'has_weeks' => 0,
                'week_window_size' => 0,
                'has_child' => 0                
            ];      
        }
        **/
        $folder->update($update);

        $global_folder_id = \DB::table('folder_ids')->where('folder_id', $folder->id)->where('folder_type', 'folder')->first()->id;
        Folder::updateTimestamp($global_folder_id, Carbon::now());
        
        $banner_id = $folder->banner_id;
        return $folder;
    }



    public static function createChildren($children, $parent)
    {
        foreach ($children as $child) {
                $folder = Folder::create([
                        'name' => $child,
                        'is_child' => 1,
                        'banner_id'=>$parent->banner_id
                    ]);
                FolderStructure::create([
                        'parent' => $parent->id,
                        'child'  => $folder->id
                    ]);
                \DB::table('folder_ids')->insert([
                    'folder_id'    => $folder->id,
                    'folder_type'  => 'folder' 
                ]);
            }
    }

    public static function removeWeeks($id)
    {
        $weeks = Week::where('parent_id',$id)->get();
            foreach ($weeks as $week) {
                
                //delete documentsin folder
                $documentsInFolder = FileFolder::where('folder_id', $week->id)->get();
                if ($documentsInFolder) {
                    foreach ($documentsInFolder as $doc) {
                        Document::where('id', $doc->document_id)->delete();
                        FileFolder::where('folder_id', $doc->folder_id)->delete();
                    }
                }
                //delete week folders
                Week::where('id', $week->id)->delete();
                \DB::table('folder_ids')->where('folder_id', $week->id)->where('folder_type', 'week')->delete();
                unset($documentsInFolder);
            }
    }


    public static function getFolderPath($global_folder_id)
    {

        $thisFolder = \DB::table('folder_ids')->where('id', $global_folder_id)->first();
        $path = [];
        array_push($path, $thisFolder);
        $finalPath = [];

        $counter = 0;
        while (!empty($path)) {
            
            $currentFolder = array_pop($path);
            
            if(isset($currentFolder->folder_type)) {
                
                if ($currentFolder->folder_type ==  'week') {
                    
                    $weekFolder = Week::where('id', $currentFolder->folder_id)->first(); 
                    
                    $finalPath[$counter]["name"] = "Week " . $weekFolder->week_number;
                    $finalPath[$counter]["global_folder_id"] = $currentFolder->id;
                    
                    $parent_id = $weekFolder->parent_id;
                    $parent = \DB::table('folder_ids')->where('id', $parent_id)->first();
                    array_push($path, $parent);

                }
                else if ($currentFolder->folder_type == 'folder') {
                    $folder_struct = FolderStructure::where('child', $currentFolder->folder_id)->first();
                    if( $folder_struct) {
   
                        //folder_id would be replace with id when folder_struct gets updated to store global_folder_id
                        $finalPath[$counter]["name"]  = Folder::where('id', $currentFolder->folder_id)->first()->name;
                        $finalPath[$counter]["global_folder_id"] = $currentFolder->id;
                        
                        $parent_id = $folder_struct->parent;
                        $parent = $parent = \DB::table('folder_ids')->where('folder_id', $parent_id)->where('folder_type', 'folder')->first(); 
                        array_push($path, $parent);
                        
                    }
                    else{
                        
                        $parent = Folder::where('id', $currentFolder->folder_id)->first();
                        $finalPath[$counter]["name"] = $parent->name;
                        $finalPath[$counter]["global_folder_id"]  = $currentFolder->id;
        
                    }
                }     
            }
            $counter++;   
        }
        $finalPath =  array_reverse($finalPath);
        return( $finalPath);
    }


    public static function getFolderChildren($global_folder_id)
    {
        $currentGlobalFolder = \DB::table('folder_ids')->where('id', $global_folder_id)->first();

        if(isset($currentGlobalFolder->folder_type)) {
                
                if ($currentGlobalFolder->folder_type ==  'week') {
                    $folder_children = [];
                    return $folder_children;
                }

                else if ($currentGlobalFolder->folder_type == 'folder') {
                    
                    $currentFolder = Folder::where('id', $currentGlobalFolder->folder_id)->first();

                    if ( $currentFolder->has_weeks ) {

                        $week_window_size = $currentFolder->week_window_size;
                        $current_week = Week::getCurrentWeek($global_folder_id);
                        $week_window = Week::getWeekWindow($current_week, $week_window_size);
                        foreach ($week_window as $week) {
                            $week->global_folder_id = \DB::table('folder_ids')->where('folder_id', $week->id )
                                                        ->where('folder_type', 'week')
                                                        ->first()->id;
                        }
                        return $week_window;

                        
                    }
                    else {
                        $children = FolderStructure::where('parent', $currentFolder->id)->get()->pluck('child');

                        $folder_children = [];
                        foreach ($children as $child) {
                            
                            $child_folder = Folder::where('id', intval($child))->first();

                            $child_global_id = \DB::table('folder_ids')->where('folder_id' , $child_folder->id)->where('folder_type', 'folder')->first();
                            $child_folder["global_folder_id"] =  $child_global_id->id;
                            array_push($folder_children, $child_folder);
                        }
                        return $folder_children;
                    }
                }
        }
        else {
            $folder_children = [];
            return $folder_children;
        }

    }
    
    public static function updateTags($id, $tags)
    {
        if (isset($tags)) {
            ContentTag::where('content_type', 'folder')->where('content_id', $id)->delete();
            foreach ($tags as $tag) {
                ContentTag::create([
                   'content_type'   => 'folder',
                   'content_id'     => $id,
                   'tag_id'         => $tag
                ]);
            }
        }
        
        return;
    }

    public static function updateTimestamp($global_folder_id, $timestamp)
    {
        $folderPath = Folder::getFolderPath($global_folder_id);
        foreach ($folderPath as $path) {
            
            $global_folder = \DB::table('folder_ids')->where('id', $path["global_folder_id"])->first();
            
            if ($global_folder->folder_type == 'folder') {   
                $folder = Folder::where('id', $global_folder->folder_id)->first();
                $folder->timestamps = false;
                $folder->last_activity_at = $timestamp;
                $folder->save();
            }
        }
    }

    public static function getFolderChildrenTree($global_folder_id)
    {
        $folder_id = \DB::table('folder_ids')->where('id',$global_folder_id)->first()->folder_id;
        $folderDetails = Folder::where('id', $folder_id)->first();
        $folderStack = new \SplStack();
        $folderStack->push($folderDetails);
        

        
        $navigation = [];
        $navCounter = 0;

        while (!$folderStack->isEmpty()) {
            
            $currentNode = $folderStack->pop();
             
            $globalFolderId = \DB::table('folder_ids')->where('folder_id', $currentNode->id )
                                                            ->where('folder_type', 'folder')
                                                            ->first()->id;
                                                             
            $navigation[$globalFolderId] =[];
            $navigation[$globalFolderId]["label"] = $currentNode->name;
            $navigation[$globalFolderId]["global_folder_id"] = $globalFolderId;

            $navigation[$globalFolderId]["is_child"] = $currentNode->is_child;

            $parentNode = FolderStructure::where('child', $currentNode->id)->first();

            if (! $parentNode == null ) {
                $navigation[$globalFolderId]["parent_id"] = $parentNode->parent;
            }
            else {
                $navigation[$globalFolderId]["parent_id"] = null;
            }

            $childNodes = FolderStructure::where('parent', $currentNode->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            
            
            if ( !$childNodes->isEmpty()) {
                        
                $counter = 0;
                $children = [];
                foreach ($childNodes as $childNode) {
                   $child = Folder::where('id', $childNode->child)->first();
                   array_push($children, $child);
                }
               
               usort($children, function($a, $b)
                {
                    return strcmp($a->name, $b->name);
                });

               foreach ($children as $child) {
                   $folderStack->push($child);
                   $navigation[$globalFolderId]["children"][$counter] = [];
                   $globalChildId = \DB::table('folder_ids')->where('folder_id', $child->id )
                                                            ->where('folder_type', 'folder')
                                                            ->first()->id;
                   $navigation[$globalFolderId]["children"][$counter]["child_id"] = $globalChildId;
                   $counter++;
               }
               unset($children);
                
            }
            else{
                
                $navigation[$globalFolderId]["children"] = [];
            }

            if ($currentNode->has_weeks) {
                $windowSize = $currentNode->week_window_size;
                $weekWindow = FolderStructure::getWeekWindow($globalFolderId, $windowSize);
                $counter = 0;
                foreach ($weekWindow as $week) {
                   
                   $navigation[$globalFolderId]["weeks"][$counter] = [];
                   $navigation[$globalFolderId]["weeks"][$counter]["week_id"] = $week->id;
                   $navigation[$globalFolderId]["weeks"][$counter]["week"]= $week->week_number;
                   $navigation[$globalFolderId]["weeks"][$counter]["global_id"] = \DB::table('folder_ids')->where('folder_id', $week->id )
                                                                                                        ->where('folder_type', 'week')
                                                                                                        ->first()->id;
                   $counter++;
                }
            }
            
            $navCounter++;   
        }
        return  ( $navigation );
    }

    public static function getGlobalFolderId($folderId)
    {
         return DB::table('folder_ids')->where('folder_id', $folderId)->first()->id;
    }

    public static function getAllDocumentsInFolderTree($folderTree)
    {
        $document_ids = [];
        foreach ($folderTree as $key=>$folder) {
            $current_folder_document_ids = FileFolder::where('folder_id', $key)->get()->pluck('document_id')->toArray(); 
            $document_ids = array_merge_recursive($document_ids, $current_folder_document_ids);
        }
        return $document_ids;
    }

}
