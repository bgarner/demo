<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationDocument;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\Tag\ContentTag;
use App\Models\Communication\CommunicationTarget;
use App\Models\Communication\CommunicationType;
use DB;
use App\Models\Utility\Utility;
use App\Models\Validation\CommunicationValidator;
use App\Models\StoreInfo;

class Communication extends Model
{
	protected $table = 'communications';
	protected $fillable = ['subject', 'body', 'sender', 'importance', 'communication_type_id', 'send_at', 'archive_at', 'is_draft', 'banner_id', 'all_stores'];


	public static function validateCreateCommunication($request)
	{
		$validateThis =  [

			'subject'               => $request['subject'],
			'start'                 => $request['send_at'],
			'end'                   => $request['archive_at'],
			'communication_type_id' => $request['communication_type_id'],
			'target_stores'         => $request['target_stores']

		];
		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

		if(isset($request['communication_documents']) && $request['communication_documents']){
		 	$validateThis['documents'] = $request['communication_documents'];
		}

		\Log::info($validateThis);
		$v = new CommunicationValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditCommunication($request)
	{
		$validateThis =  [

			'subject'               => $request['subject'],
			'start'                 => $request['send_at'],
			'end'                   => $request['archive_at'],
			'communication_type_id' => $request['communication_type_id'],
			'target_stores'         => $request['target_stores']

		];

		if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }
        
		if(isset($request['communication_documents']) && $request['communication_documents']){
		 	$validateThis['documents'] = $request['communication_documents'];
		}
		if(isset($request['remove_document']) && $request['remove_document']){
		 	$validateThis['remove_document'] = $request['remove_document'];
		}

		\Log::info($validateThis);
		$v = new CommunicationValidator();
		return $v->validate($validateThis);
	}

	public static function getAllCommunication($banner_id)
	{
		$communicatons = Communication::where('banner_id', $banner_id)->get();
		foreach($communicatons as $c){
			$c->prettySentAtDate = Utility::prettifyDate( $c->send_at );
		}
		return $communicatons;
	}

	public static function getCommunicationByStoreNumber($request, $storeNumber)
	{
	 
		$isValidCommunicationType = CommunicationType::isValidCommunicationType($request['type']);
		if ($isValidCommunicationType) {
			
		    $targetedCommunications = CommunicationTarget::getTargetedCommunicationsByCategory($storeNumber, $request['type']);
		}
		else {
		    $targetedCommunications = CommunicationTarget::getTargetedCommunications($storeNumber);
		}

		if (isset($request['archives']) && !empty($request['archives'])) {

		    if($isValidCommunicationType){
		        $archivedCommunication = Communication::getArchivedCommunicationsByCategory($request['type'], $storeNumber);
		        foreach ($archivedCommunication as $ac) {
		            $targetedCommunications->add($ac);
		        }
		    }

		    else{

		        $archivedCommunication = Communication::getArchivedCommunicationsByStoreNumber($storeNumber);
		        foreach ($archivedCommunication as $ac) {
		            $targetedCommunications->add($ac);
		        }
		    }

		}

		return $targetedCommunications;
	}

	public static function getActiveCommunicationsByStoreNumber($storeNumber, $maxToFetch=100)
	{

		$banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;
		$now = Carbon::now();
		
		$allStoreComm = Communication::where('all_stores', 1)
                                    ->where('banner_id', $banner_id)
                                    ->where('communications.send_at', '<=', $now )
                                    ->where('communications.archive_at', '>=', $now )
                                    ->get();

		$targetedComm = CommunicationTarget::where('store_id', $storeNumber)
						->join('communications', 'communications.id', '=', 'communications_target.communication_id')
						->where('communications.send_at', '<=', $now )
						->where('communications.archive_at', '>=', $now )
						->get();

		$comm = $allStoreComm->merge($targetedComm)->each(function($c){

				$c->since = Utility::getTimePastSinceDate($c->send_at);
				$c->prettyDate = Utility::prettifyDate($c->send_at);
				$preview_string = strip_tags($c->body);
				$c->trunc = Communication::truncateHtml($preview_string);
			})->sortByDesc('send_at')
				->take($maxToFetch);
		
		return $comm;

	}

	public static function getArchivedCommunicationsByStoreNumber($storeNumber)
	{
		$now = Carbon::now();

		$comm = Communication::join('communications_target', 'communications.id' , '=', 'communications_target.communication_id')
						  ->where('store_id', $storeNumber)
						  ->where('archive_at', '<=', $now)
						  ->select('communications.*')
						  ->orderBy('communications.send_at', 'desc')
						  ->get();

		foreach($comm as $c){
			$c->archived = true;
			$c->since = Utility::getTimePastSinceDate($c->send_at);
			$c->prettyDate = Utility::prettifyDate($c->send_at);
			$preview_string = strip_tags($c->body);
			$c->trunc = Communication::truncateHtml($preview_string);
			$c->label_name = Communication::getCommunicationCategoryName($c->communication_type_id);
			$c->label_colour = Communication::getCommunicationCategoryColour($c->communication_type_id);
			$c->has_attachments = Communication::hasAttachments($c->id);
		}
		return $comm;
	}
	public static function getArchivedCommunicationsByCategory($category, $storeNumber)
	{
	 	$now = Carbon::now()->toDatetimeString();

	 	$comm = Communication::join('communications_target', 'communications.id' , '=', 'communications_target.communication_id')
						  ->join('communication_types', 'communication_types.id', '=', 'communications.communication_type_id' )
						  ->where('communications.communication_type_id' , $category)
						  ->where('store_id', $storeNumber)
						  ->where('archive_at', '<=', $now)
						  ->select('communications.*')
						  ->orderBy('communications.send_at', 'desc')
						  ->get();

		foreach($comm as $c){
			$c->archived        = true;
			$c->since           = Utility::getTimePastSinceDate($c->send_at);
			$c->prettyDate      = Utility::prettifyDate($c->send_at);
			$preview_string     = strip_tags($c->body);
			$c->trunc           = Communication::truncateHtml($preview_string);
			$c->label_name      = Communication::getCommunicationCategoryName($c->communication_type_id);
			$c->label_colour    = Communication::getCommunicationCategoryColour($c->communication_type_id);
			$c->has_attachments = Communication::hasAttachments($c->id);
		}
		return $comm;
	}


	public static function getCommunicationById($id)
	{
		$communication             = Communication::find($id);
		$communication->since      = Utility::getTimePastSinceDate($communication->send_at);
		$communication->prettyDate = Utility::prettifyDate($communication->send_at);
		return $communication;

	}

	public static function storeCommunication($request)
	{
		\Log::info($request->all());
		$validate = Communication::validateCreateCommunication($request);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}
		$is_draft = 0;
		if ($request["send_at"]>Carbon::now()) {
			$is_draft = 1;
		}
		$communication = Communication::create([
			'subject'               => $request["subject"],
			'communication_type_id' => $request["communication_type_id"],
			'body'                  => $request["body"],
			'sender'                => "",
			'importance'            => 1,
			'is_draft'              => $is_draft,
			'send_at'               => $request["send_at"],
			'archive_at'            => $request["archive_at"],
			'banner_id'             => $request["banner_id"]
		]);

		Communication::updateTargetStores($communication->id, $request);
		Communication::updateCommunicationDocuments($communication->id, $request);
		Communication::updateCommunicationPackages($communication->id, $request);
		return $communication;
	}

	public static function updateCommunication($id, $request)
	{


		\Log::info($request->all());
		$validate = Communication::validateEditCommunication($request);

		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}


		$communication = Communication::find($id);

		$communication["subject"] = $request["subject"];
		$communication["body"]    = $request["body"];
		if (isset($request['communication_type_id'])) {
			$communication["communication_type_id"] = $request["communication_type_id"];
		}
		
		$communication["sender"]     = $request["sender"];
		$communication["importance"] = $request["importance"];
		$communication["send_at"]    = $request["send_at"];
		$communication["archive_at"] = $request["archive_at"];
		if ($request["send_at"] > Carbon::now()) {
		$communication["is_draft"]   = 1;
		}
		else {
		$communication["is_draft"]   = 0;
		}

		$communication->save();

		Communication::updateTargetStores($communication->id, $request);
		Communication::updateCommunicationDocuments($communication->id, $request);
		Communication::updateCommunicationPackages($communication->id, $request);

		return $communication;

	}

	public static function updateTargetStores($id, $request)
	{
		$target_stores = $request['target_stores'];
        $allStores = $request['all_stores'];
        if($allStores == 'on') {
            CommunicationTarget::where('communication_id', $id)->delete();
            $communication = Communication::find($id);
            $communication->all_stores = 1;
            $communication->save();
        }
        else{
            CommunicationTarget::where('communication_id', $id)->delete();
            if (count($target_stores) > 0) {
                foreach ($target_stores as $store) {
                    CommunicationTarget::create([
                        'communication_id'   => $id,
                        'store_id'   => $store
                    ]);
                }
            } 
            $communication = Communication::find($id);
            $communication->all_stores = 0;
            $communication->save();
        }
         
        return;
	}

	public static function updateCommunicationDocuments($id, $request)
	{
		$remove_docs = $request["remove_document"];
		if (isset($remove_docs)) {
			foreach ($remove_docs as $doc) {
			   CommunicationDocument::where('communication_id', $id)->where('document_id', intval($doc))->delete();
			}
		}

		$add_docs = $request["communication_documents"];
		if (isset($add_docs)) {
			foreach ($add_docs as $doc) {
			   CommunicationDocument::create([
				  'communication_id' => $id,
				  'document_id'      => $doc
			   ]);
			}
		}
	}

	public static function updateCommunicationPackages($id, $request)
	{
		$remove_packages = $request["remove_package"];
		if (isset($remove_packages)) {
			foreach ($remove_packages as $package) {
			   CommunicationPackage::where('communication_id', $id)->where('package_id', intval($package))->delete();
			}
		}

		$add_packages = $request["communication_packages"];
		if (isset($add_packages)) {
			foreach ($add_packages as $package) {
				CommunicationPackage::create([
					'communication_id'=> $id,
					'package_id'      => $package
				]);
			}
		}
	}

	public static function getDocumentDetails($id)
	{
		$communication_document_list = CommunicationDocument::where('communication_id', $id)->get();
		$documents = [];
		foreach ($communication_document_list as $list_item) {
			$doc                   = Document::find($list_item->document_id);
			$doc["folder_path"]    = Document::getFolderPathForDocument($list_item->document_id);
			$doc["link"]           = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 0);
			$doc["link_with_icon"] = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
			$doc["icon"]           = Utility::getIcon($doc->original_extension);
			$doc["anchor_only"]    = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1, 1);

			$doc["prettyDate"]     = Utility::prettifyDate($doc->updated_at);
			$doc["since"]          = Utility::getTimePastSinceDate($doc->updated_at);
			array_push($documents, $doc);
		}
		return $documents;
	}

	public static function getPackageDetails($id)
	{
		$communication_package_list = CommunicationPackage::where('communication_id', $id)->get();

		$packages = [];
		foreach ($communication_package_list as $list_item) {
			$package = Package::find($list_item->package_id);
			$package["documents"] = [];
			$package_docs = Package::getPackageDocumentDetails($list_item->package_id);
			$package["documents"] = $package_docs;
			array_push($packages, $package);
		}
		return $packages;
	}

	public static function updateTags($id, $tags)
	{
		if (isset($tags)) {
			ContentTag::where('content_type', 'communication')->where('content_id', $id)->delete();
			foreach ($tags as $tag) {
				ContentTag::create([
						'content_type' => 'communication',
						'content_id'      => $id,
						'tag_id'          => $tag
				]);
			}
		}

		return;
	}

	public static function deleteCommunication($id)
	{
		Communication::find($id)->delete();
		CommunicationPackage::where('communication_id', $id)->delete();
		CommunicationDocument::where('communication_id', $id)->delete();
		CommunicationTarget::where('communication_id', $id)->delete();
		ContentTag::where('content_id', $id)->where('content_type', 'communication')->delete();
		return;
	}

	public static function getCommunicationCountByStoreNumber($request, $storeNumber)
	{
		if(isset($request['archives']) && $request['archives'] !== ""){
			return Communication::getAllCommunicationCount($storeNumber);

		}

		else{
			return Communication::getActiveCommunicationCount($storeNumber);
		}


	}

	public static function getActiveCommunicationCount($storeNumber)
	{
		$now = Carbon::now()->toDatetimeString();

		$communicationCount = DB::table('communications_target')
						->join('communications', 'communications_target.communication_id', '=', 'communications.id')
						->where('store_id', $storeNumber)
						->where('communications.send_at' , '<=', $now)
						->where('communications.archive_at', '>=', $now)
						// ->whereNull('is_read')
						->count();

		return $communicationCount;
	}

	public static function getAllCommunicationCount($storeNumber)
	{
		$communicationCount = DB::table('communications_target')
						->join('communications', 'communications_target.communication_id', '=', 'communications.id')
						->where('store_id', $storeNumber)
						->count();
		return $communicationCount;
	}

	public static function getActiveCommunicationCountByCategory($storeNumber, $categoryId)
	{
		$now = Carbon::now()->toDatetimeString();

		$count = DB::table('communications_target')
					->where('store_id', $storeNumber)
					->join('communications', 'communications.id', '=', 'communications_target.communication_id')
					->where('communications.communication_type_id', $categoryId)
					->where('communications.send_at' , '<=', $now)
					->where('communications.archive_at', '>=', $now)
					->count();
		return $count;
	}

	public static function getAllCommunicationCountByCategory($storeNumber, $categoryId)
	{
		$count = DB::table('communications_target')
					->where('store_id', $storeNumber)
					->join('communications', 'communications.id', '=', 'communications_target.communication_id')
					->where('communications.communication_type_id', $categoryId)
					->count();
		return $count;
	}

	public static function getActiveCommunicationsForStoreList($storeNumbersArray)
	{
		$now = Carbon::now()->toDatetimeString();
		$communications = Communication::join('communications_target', 'communications_target.communication_id' ,  '=', 'communications.id')
								   ->whereIn('communications_target.store_id', $storeNumbersArray)
								   ->where('communications.send_at' , '<=', $now)
								   ->where('communications.archive_at', '>=', $now)
								   ->whereNull('communications.deleted_at')
								   ->whereNull('communications_target.deleted_at')
								   ->select('communications.*', 'communications_target.store_id')
								   ->get()
								   ->toArray();
	 	$compiledComm = [];

		foreach ($communications as $communication) {
			$index = array_search($communication['id'], array_column($compiledComm, 'id'));
			if(  $index !== false ){
				array_push($compiledComm[$index]->stores, $communication["store_id"]);
			}
			else{

				$communication["stores"] = [];
				array_push( $communication["stores"] , $communication["store_id"]);
				array_push( $compiledComm , (object) $communication);
			}
		}
	 	return (object)($compiledComm);
	}

	public static function getCommunicationCategoryName($id)
	{
		if(isset($id) && !empty($id)){

			if( CommunicationType::find($id) ){
				return CommunicationType::where('id', $id)->first()->communication_type;   
			}
		}
	 
	}

	public static function getCommunicationCategoryColour($id)
	{
		return CommunicationType::where('id', $id)->first()->colour;
	}


	public static function hasAttachments($id)
	{
		$hasAttachments = CommunicationDocument::where('communication_id', $id)->get();
		$hasPackages = CommunicationPackage::where('communication_id', $id)->get();

		if( count($hasAttachments)>0 || count($hasPackages) >0 ){
			return true;
		}

		return false;
	}

	public static function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
	{
		if ($considerHtml) {
			// if the plain text is shorter than the maximum length, return the whole text
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				return $text;
			}
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings) {
			   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
			   	if (!empty($line_matchings[1])) {
				  	// if it's an "empty element" with or without xhtml-conform closing slash
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				  	// if tag is a closing tag
				  	}
				  	else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					 // delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
					 	if ($pos !== false) {
					 	unset($open_tags[$pos]);
					}
				  	// if tag is an opening tag
				  	}
				  	else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					 	// add tag to the beginning of $open_tags list
					 	array_unshift($open_tags, strtolower($tag_matchings[1]));
				  	}
				  	// add html-tag to $truncate'd text
				  	$truncate .= $line_matchings[1];
			   	}
			   	// calculate the length of the plain text part of the line; handle entities as one character
			   	$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			   	if ($total_length+$content_length> $length) {
				  	// the number of characters which are left
				  	$left = $length - $total_length;
				  	$entities_length = 0;
				  	// search for html entities
				  	if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					 // calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity) {
							if ($entity[1]+1-$entities_length <= $left) {
						   		$left--;
						   		$entities_length += strlen($entity[0]);
							} else {
						   	// no more characters left
						   		break;
							}
					 	}
				  	}
				  	$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				  	// maximum lenght is reached, so get off the loop
				  	break;
			   	} 
			   	else {
				  	$truncate .= $line_matchings[2];
				  	$total_length += $content_length;
			   	}
			   	// if the maximum length is reached, get off the loop
			   	if($total_length>= $length) {
				  	break;
			   	}
			}
		} 
		else {
			if (strlen($text) <= $length) {
		   		return $text;
			} else {
		   		$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		// if the words shouldn't be cut in the middle...
		if (!$exact) {
			// ...search the last occurance of a space...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos)) {
		   		// ...and cut the text in this position
		   		$truncate = substr($truncate, 0, $spacepos);
			}
		}
		// add the defined ending to the text
		$truncate .= $ending;
		if($considerHtml) {
			// close all unclosed html-tags
			foreach ($open_tags as $tag) {
		   		$truncate .= '</' . $tag . '>';
			}
		}
		return $truncate;
	}

}
