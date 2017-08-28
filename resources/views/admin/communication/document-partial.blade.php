{{--@foreach($communication_documents as $doc)
<div class="row">
	<div class="feature-files col-md-8">
		<div class="feature-filename" data-fileid = "{{$doc->id}}"> {!! $doc->link_with_icon !!} </div>
			 <div class="feature-filepath"> File Location : {{$doc->folder_path}}</div>
			<div class="feature-timestamp"> Uploaded At : {{$doc->created_at}}</div>
	</div>

	<!-- <div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div> -->
	<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
</div>
@endforeach--}}


<!-- <div id="files-selected"> -->
	@if(count($communication_documents) > 0)
	<table class="table table-hover communication-documents-table">
	@else
	<table class="table table-hover communication-documents-table hidden">
	@endif
		<thead>
			<tr>
				<td>Title</td>
				<td></td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>
			@foreach($communication_documents as $doc)
			<tr class="communication-documents" data-fileid="{{$doc->id}}">
				<td class="col-sm-10 col-sm-offset-2 feature-documents" data-fileid="{{$doc->id}}">
                	{!! $doc->link_with_icon !!}
                </td>
				<td></td>
				<td>
					<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
<!-- </div> -->