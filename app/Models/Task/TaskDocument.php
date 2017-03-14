<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Utility\Utility;

class TaskDocument extends Model
{
    protected $table = 'task_document';

    protected $fillable = ['task_id', 'document_id'];

    public static function getDocumentsByTaskId($id)
    {
    	$task_document_list = TaskDocument::where('task_id', $id)->get();
		
		$documents = [];

		foreach ($task_document_list as $list_item) {
			$doc = Document::find($list_item->document_id);
			$doc["folder_path"] = Document::getFolderPathForDocument($list_item->document_id);
			$doc["link"] = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 0);
			$doc["link_with_icon"] = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
			$doc["icon"] = Utility::getIcon($doc->original_extension);
			array_push($documents, $doc);
		}
		return $documents;	
    }

    public static function updateTaskDocuments($id, $request)
	{
		$remove_docs = $request["remove_document"];
		if (isset($remove_docs)) {
			foreach ($remove_docs as $doc) {
			   TaskDocument::where('task_id', $id)->where('document_id', intval($doc))->delete();
			}
		}

		$add_docs = $request["task_documents"];
		if (isset($add_docs)) {
			foreach ($add_docs as $doc) {
				TaskDocument::create([
				  'task_id'   => $id,
				  'document_id'      => $doc
				]);
			}
		}	
	}
}
