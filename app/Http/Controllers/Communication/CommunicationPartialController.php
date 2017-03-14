<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Communication\Communication;

class CommunicationPartialController extends Controller
{
    public function getCommunicationDocumentPartial($communication_id)
    {
        $documents = Communication::getDocumentDetails($communication_id);

        return view('admin.communication.document-partial')->with('communication_documents', $documents);
    }
}
