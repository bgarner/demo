<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\Communication\CommunicationType;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Skin;
use App\Models\StoreInfo;
use App\Models\Document\Document;
use Carbon\Carbon;
use App\Models\Utility\Utility;


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

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $communicationTypes = CommunicationType::getCommunicationTypeCount($storeNumber, $storeBanner);


        if (isset($request['type']) && $request['type'] !== "") {
            $targetedCommunications = CommunicationTarget::getTargetedCommunicationsByCategory($storeNumber, $request['type']);
            $title = \DB::table('communication_types')->where('id', $request['type'])->first()->communication_type;
        }
        else {
            $targetedCommunications = CommunicationTarget::getTargetedCommunications($storeNumber);
            $title = "";
        }

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);

        if (isset($request['archives']) && $request['archives']) {

            $communicationCount = Communication::getAllCommunicationCount($storeNumber);
            $communicationTypes = CommunicationType::getCommunicationTypeCountAllMessages($storeNumber, $storeBanner);

            if(isset($request['type']) && $request['type'] !== ""){
                $archivedCommunication = Communication::getArchivedCommunicationsByCategory($request['type'], $storeNumber);
                foreach ($archivedCommunication as $ac) {
                    $targetedCommunications->add($ac);
                }
            }

            else{

                $archivedCommunication = Communication::getArchivedCommunicationsByStore($storeNumber);
                foreach ($archivedCommunication as $ac) {
                    $targetedCommunications->add($ac);
                }
            }

        }

        return view('site.communications.index')
            ->with('skin', $skin)
            ->with('communicationTypes', $communicationTypes)
            ->with('communications', $targetedCommunications)
            ->with('communicationCount', $communicationCount)
            ->with('alertCount', $alertCount)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('title', $title)
            ->with('archives', $request['archives'])
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);

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
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $banner = Banner::find($storeBanner);
        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);
        $communicationTypes = CommunicationType::getCommunicationTypeCount($storeNumber, $storeBanner);

        $communication = Communication::getCommunication($id);

        $communication_documents = CommunicationDocument::where('communication_id', $id)->get()->pluck('document_id');
        $selected_documents = array();
        foreach ($communication_documents as $doc_id) {

            $doc = Document::find($doc_id);
            $doc->folder_path = Document::getFolderPathForDocument($doc_id);

            $doc->link = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 0);
            $doc->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
            $doc->anchor_only =  Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1, 1);
            $doc->icon = Utility::getIcon($doc->original_extension);


            $doc->prettyDate = Utility::prettifyDate($doc->updated_at);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);

            array_push($selected_documents, $doc );
        }


        $communicationPackages = Communication::getPackageDetails($id);
        $communicationDocuments = Communication::getDocumentDetails($id);


        $communication_packages = CommunicationPackage::where('communication_id', $id)->get()->pluck('package_id');
        $selected_packages = [];

        foreach ($communication_packages as $package_id) {
            $package = Package::find($package_id);
            $package_details = Package::getPackageDetails($package_id);
            $package['details'] = $package_details;
            array_push($selected_packages, $package);

        }

        if (isset($request['archives']) && $request['archives']) {
            $communicationCount = Communication::getAllCommunicationCount($storeNumber);
            $communicationTypes = CommunicationType::getCommunicationTypeCountAllMessages($storeNumber , $storeBanner);
        }

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        return view('site.communications.message')
            ->with('skin', $skin)
            ->with('communicationTypes', $communicationTypes)
            ->with('communicationCount', $communicationCount)
            ->with('communication', $communication)
            ->with('communication_documents', $selected_documents)
            ->with('communication_packages', $selected_packages)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('alertCount', $alertCount)
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);

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
