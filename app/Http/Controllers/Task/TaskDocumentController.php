<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Task\TaskDocument;

class TaskDocumentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = TaskDocument::getDocumentsByTaskId($id);

        return view('admin.task.document-partial')->with('task_documents', $documents);   
    }

}
