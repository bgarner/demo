<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document\FileFolder;
use App\Models\Document\Document;

class DocumentFolderAdminController extends Controller
{
    public function update(Request $request, $id)
    {
    	\Log::info($request->all());
    	FileFolder::updateDocumentFolder($id, $request);
    	return json_encode( ['path'=> Document::getFolderPathForDocument($id)]);
    }
}
