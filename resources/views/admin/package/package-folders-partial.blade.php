@foreach($folders as $folder)
<div class="row">
	<div class="package-folders col-md-8">
		<div class="package-foldername" data-folderid = {{$folder->global_folder_id}}> <i class="fa fa-folder-o"></i> {{$folder->name}} </div>
		<?php $folder_path = $folder->folder_path; ?>
		<div class="package-folderpath"> Folder Location :
			@foreach($folder_path as $path)
				{{ "/" . $path["name"] }}
			@endforeach
			
		</div>
		<div class="package-timestamp"> Updated At : {{$folder->updated_at}}</div>
	</div>

	<!-- <div class="col-md-1 remove-folder btn btn-default" data-document-id="{{$folder->id}}">Remove</div> -->
	<a data-folder-id="{{ $folder->global_folder_id }}" id="folder{{$folder->global_folder_id}}" class="remove-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
</div>
@endforeach