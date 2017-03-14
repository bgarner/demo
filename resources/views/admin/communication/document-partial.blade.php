@foreach($communication_documents as $doc)
<div class="row">
	<div class="feature-files col-md-8">
		<div class="feature-filename" data-fileid = "{{$doc->id}}"> {!! $doc->link_with_icon !!} </div>
		{{-- <div class="feature-filepath"> File Location : {{$doc->folder_path}}</div>
			<div class="feature-timestamp"> Uploaded At : {{$doc->created_at}}</div>--}}
	</div>

	<!-- <div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div> -->
	<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
</div>
@endforeach