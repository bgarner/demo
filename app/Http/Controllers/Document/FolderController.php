<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\Folder;

class FolderController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $folder_id = RequestFacade::segment(3);
        
        $storeNumber = strval(RequestFacade::segment(1));

        $documents = Document::getDocuments($folder_id, true, $storeNumber);
        \Log::info($folder_id);
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
