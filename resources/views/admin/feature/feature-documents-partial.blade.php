@if(isset($documents) && count($documents)>0)
<table class="table table-hover feature-documents-table  ">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

        @foreach($documents as $document)

        <tr class="feature-documents">
            <td data-document-id="{{$document->id}}" > {{$document->original_filename}} </td>
            <td></td>
            <td> <a data-document-id="{{$document->id}}" id="file{{$document->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>

        @endforeach
	</tbody>

</table>
@else
<table class="table table-hover feature-documents-table hidden">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif