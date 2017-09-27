<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\FolderStructure;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Document\Week;

class ApiController extends Controller
{
     public function getNavigation($id)
    {
        $banner_id = $id;
        return FolderStructure::getNavigationStructure($banner_id);

    }

    public function getDocumentsInFolder($id, Request $request)
    {
        $folder_id = $id;

        $forApi = true;

        return Document::getDocuments($folder_id, $forApi);

    }

    public function getDocumentById($id)
    {
        return Document::getDocumentById($id);
    }

    public function getRecentDocuments($banner_id, $numberOfDays)
    {
        return Document::getRecentDocuments($banner_id, $numberOfDays);
    }
    public function getArchivedDocuments($id)
    {
        $folder_id = $id;
        return Document::getArchivedDocuments($folder_id);
    }
}
