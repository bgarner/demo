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
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Skin;
use App\Models\StoreInfo;


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

        $skin = Skin::getSkin($storeBanner);

        $targetedCommunications = DB::table('communications_target')
                ->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                ->where('communications_target.store_id', '=', $storeNumber)
                ->get();

        $i=0;
        foreach($targetedCommunications as $tc){
            $targetedCommunications[$i]->trunc = Communication::truncateHtml($targetedCommunications[$i]->body);
            $i++;
        }

        $communicationCount = Communication::getCommunicationCount($storeNumber); 

        $communicationTypes = CommunicationType::all();

        $i = 0;
        foreach($communicationTypes as $ct){
            $communicationTypes[$i]->count = Communication::getCommunicationCountByCategory($storeNumber, $ct->id);
            $i++;
        }


        return view('site.communications.index')
            ->with('skin', $skin)
            ->with('communicationTypes', $communicationTypes)
            ->with('communications', $targetedCommunications)
            ->with('communicationCount', $communicationCount);
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
    public function show($sn, $id)
    {
        $communication = Communication::find($id);
        $tag_ids = ContentTag::where('content_id', $id)->where("content_type", "communication")->get()->pluck("tag_id");
        $tags = Tag::findmany($tag_ids);
        return view('site.communications.message')
            ->with('communication', $communication)
            ->with('tag_ids', $tag_ids)
            ->with('tags', $tags);
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
