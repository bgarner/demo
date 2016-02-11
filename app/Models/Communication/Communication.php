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

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillable = ['subject', 'body', 'sender', 'importance', 'communication_type_id', 'send_at', 'archive_at', 'is_draft', 'banner_id'];

   	public static function getAllCommunication($banner_id)
      {
         return $communicatons = Communication::where('banner_id', $banner_id)->get();
      }

      public static function getCommunicationsByStoreNumber($storeNumber, $maxToFetch)
      {
        
         $comm = DB::table('communications_target')->where('store_id', $storeNumber)
                            ->join('communications', 'communications.id', '=', 'communications_target.communication_id')
                            ->take($maxToFetch)
                            ->get();

         foreach($comm as $c){
            $updated_at = new Carbon($c->updated_at);

            $since = Carbon::now()->diffForHumans($updated_at, true);
            $c->since = $since;
            $c->prettyDate = $updated_at->toDayDateTimeString();
            $c->trunc = Communication::truncateHtml($c->body);
         }
         return $comm;
         
      }


      public static function getCommunication($id)
      {
         $communication = Communication::find($id);
         Communication::prettify($communication);
         return $communication;

      }

      public static function storeCommunication($request)
   	{
   		\Log::info($request->all());
         $is_draft = 0;
   		if ($request["send_at"]>Carbon::now()) {
   			$is_draft = 1;
   		}
   		$communication = Communication::create([
   			'subject' 	=> $request["subject"],
            'communication_type_id' => $request["communication_type_id"],
   			'body'		=> $request["body"],
            'sender' => "",
            'importance'=> 1,
            'is_draft'  => $is_draft,
   			'send_at'	=> $request["send_at"],
   			'archive_at'=> $request["archive_at"],
   			'banner_id' => $request["banner_id"]
   		]);

         Communication::updateTargetStores($communication->id, $request);
         Communication::updateCommunicationDocuments($communication->id, $request);
         Communication::updateCommunicationPackages($communication->id, $request);
         //Communication::updateTags($communication->id, $request["tags"]);
   		return $communication;
   	}

      public static function updateCommunication($id, $request)
      {
         $communication = Communication::find($id);

         $communication["subject"] = $request["subject"];
         $communication["body"] = $request["body"];
         $communication["sender"] = $request["sender"];
         $communication["importance"] = $request["importance"];
         $communication["send_at"] = $request["send_at"];
         $communication["archive_at"] = $request["archive_at"];
         if ($request["send_at"] > Carbon::now()) {
            $communication["is_draft"] = 1;
         }
         else {
            $communication["is_draft"] = 0;
         }
         $communication->save();

         Communication::updateTargetStores($id, $request);
         Communication::updateCommunicationDocuments($id, $request);
         Communication::updateCommunicationPackages($id, $request);
         Communication::updateTags($communication->id, $request["tags"]);

         return;


      }

      public static function updateTargetStores($id, $request)
      {
         CommunicationTarget::where('communication_id', $id)->delete();
         
         $stores = $request["target_stores"];
         if (count($stores>0)) {
            foreach ($stores as $store) {
               CommunicationTarget::create([
                  'communication_id'   => $id,
                  'store_id'           => $store
               ]);
            
            }
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
                  'communication_id'   => $id,
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
                  'communication_id'   => $id,
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
            $doc = Document::find($list_item->document_id);
            $doc["folder_path"] = Document::getFolderPathForDocument($list_item->document_id);
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

      public static function getCommunicationCount($storeNumber)
      {
         $communicationCount = DB::table('communications_target')
           ->where('store_id', $storeNumber)
           ->whereNull('is_read')
           ->count();

         return $communicationCount;
      }

      public static function getCommunicationCountByCategory($storeNumber, $categoryId)
      {
         $count = DB::table('communications_target')
           ->where('store_id', $storeNumber)
           ->join('communications', 'communications.id', '=', 'communications_target.communication_id')
           ->where('communications.communication_type_id', $categoryId)
           ->count();
         return $count;
      } 

      public static function getCommunicationCategoryName($id)
      {
         return CommunicationType::where('id', $id)->first()->communication_type;
      }

      public static function getCommunicationCategoryColour($id)
      {
         return CommunicationType::where('id', $id)->first()->colour;
      }

      public static function prettify($communication)
      {
        // get the human readable days since send
        $send_at = Carbon::createFromFormat('Y-m-d H:i:s', $communication->send_at);
        $since = Carbon::now()->diffForHumans($send_at, true);
        $communication->since = $since;

        //make the timestamp on the message a little nicer
        $communication->prettyDate = $send_at->format('D j F');
        
        return $communication;
      }      

     public static function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
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
                  } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                     // delete tag from $open_tags list
                     $pos = array_search($tag_matchings[1], $open_tags);
                     if ($pos !== false) {
                     unset($open_tags[$pos]);
                     }
                  // if tag is an opening tag
                  } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
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
               } else {
                  $truncate .= $line_matchings[2];
                  $total_length += $content_length;
               }
               // if the maximum length is reached, get off the loop
               if($total_length>= $length) {
                  break;
               }
            }
         } else {
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
