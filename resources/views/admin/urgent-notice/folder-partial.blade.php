@if(isset($folders) && count($folders)>0)
<table class="table table-hover urgentnotice-folders-table">
	<thead>
		<tr>
			<th>Folder Name</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	
	
        @foreach ($folders as $folder)
        
	   <tr class="urgentnotice-folders">
            <td data-folder-id='{{$folder->global_folder_id}}'> {{$folder->name}} </td>
            <td></td>
            <td> <a data-folder-id='{{$folder->global_folder_id}}' id="folder{{$folder->global_folder_id}}" class="remove-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
    </tbody>
	
	

</table>
@else
<table class="table table-hover feature-folders-table hidden">
	<thead>
		<tr>
			<th>Folder Name</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif