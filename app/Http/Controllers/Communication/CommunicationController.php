<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationType;


class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $communicationTypes = CommunicationType::getCommunicationTypesByStoreNumber($request, $storeNumber);

        $communicationCount = Communication::getCommunicationCountByStoreNumber($request, $storeNumber);

        $title = Communication::getCommunicationCategoryName($request['type']);

        $communications = Communication::getCommunicationByStoreNumber($request, $storeNumber);
        
        return view('site.communications.index')
            ->with('communicationTypes', $communicationTypes)
            ->with('communications', $communications)
            ->with('communicationCount', $communicationCount)
            ->with('title', $title)
            ->with('archives', $request['archives']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sn, $id, Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $communicationTypes = CommunicationType::getCommunicationTypesByStoreNumber($request, $storeNumber);

        $communicationCount = Communication::getCommunicationCountByStoreNumber($request, $storeNumber);

        $communication = Communication::getCommunicationById($id);

        $communicationPackages = Communication::getPackageDetails($id);
        $communicationDocuments = Communication::getDocumentDetails($id);


        return view('site.communications.message')
            ->with('communicationTypes', $communicationTypes)
            ->with('communicationCount', $communicationCount)
            ->with('communication', $communication)
            ->with('communication_documents', $communicationDocuments)
            ->with('communication_packages', $communicationPackages);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
