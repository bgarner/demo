@foreach($task_documents as $doc)
<div class="row">
	<div class="feature-files col-md-8">
		<div class="feature-filename" data-fileid = "{{$doc->id}}"> {!! $doc->link_with_icon !!} </div>
	</div>
	<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
</div>
@endforeach