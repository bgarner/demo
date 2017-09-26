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