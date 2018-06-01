<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Document\Document;
use App\Models\Document\Folder;


class FolderManagerController extends Controller
{
    public function show($folder_id)
    {

    	$this->user_id = \Auth::user()->id;
        $stores = StoreInfo::getStoreListingByManagerId($this->user_id);
        $storeList = array_column($stores, 'store_number');

        $documents = Document::getDocumentsForManager($folder_id, $storeList);

        $folder = Folder::getFolderDescription($folder_id);
        $response = [];
        // $response["files"] = $documents;

        if (isset($request['archives']) && $request['archives'] == true) {
            $archivedDocuments = Document::getArchivedDocumentsByStoreNumber($folder_id, $storeNumber);
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
        return $response;
    }
}
