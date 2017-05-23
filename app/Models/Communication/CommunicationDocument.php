<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationDocument extends Model
{
    protected $table = 'communication_document';
    protected $fillable = ['communication_id', 'document_id'];

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

	public static function getDocumentsByCommunicationId($id)
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
}
