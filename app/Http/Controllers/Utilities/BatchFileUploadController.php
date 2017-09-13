<?php

namespace App\Http\Controllers\Utilities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Document\Document;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Utility\Utility;

class BatchFileUploadController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.documentmanager.document-upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Document::batchUpload($request);
    }
}
