<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Document\Document;
use App\Models\Document\Folder;


class FolderManagerController extends Controller
{
    public function show($folder_id, Request $request)
    {

    	$this->user_id = \Auth::user()->id;
        $storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        $storeList = $storesByBanner->flatten()->toArray();

        $documents = Document::getDocumentsForManager($folder_id, $storeList);

        $folder = Folder::getFolderDescription($folder_id);
        $response = [];
        
        
        if (isset($request['archives']) && $request['archives'] == true) {
            
            $archivedDocuments = Document::getArchivedDocumentsByStorelist($folder_id, $storeList);
            
           
            if(count($archivedDocuments)>0){
                
                if(count($documents)>0){
                    $documents = $documents->merge($archivedDocuments);
                }
                else{
                    $documents = $archivedDocuments;
                }
                
            }
            
        }
        
        $response["files"] = $documents;
        $response["folder"] = $folder;

        // \Log::info($response);
        return $response;
    }
}
