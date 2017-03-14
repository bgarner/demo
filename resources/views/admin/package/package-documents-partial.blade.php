@foreach($documentDetails as $doc)
	<div class="row">
		<div class="package-files col-md-8">
			<div class="package-filename" data-fileid = "{{$doc->id}}"> <i class="fa fa-file-o"></i> {{$doc->original_filename}} </div>
			<div class="package-filepath"> File Location : {{$doc->folder_path}}</div>
			<div class="package-timestamp"> Uploaded At : {{$doc->created_at}}</div>
		</div>

		<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
	</div>
@endforeach