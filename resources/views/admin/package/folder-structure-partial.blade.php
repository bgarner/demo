@if(count($folder["children"]) >0 )
	<li id={{$folder["id"]}} class="folder-item">
		 <input type="checkbox" class="folder-checkbox" name = "package_folders[]" value = {{$folder["id"]}} data-folderid = {{$folder["id"]}} data-foldername = "{{$folder["label"]}}"  > {{$folder["label"]}} 
	<ul>
	@foreach ($folder["children"] as $child)
	<?php $folder = $folderStructure[$child["child_id"]] ?>
	@include('admin.package.folder-structure-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($folder["weeks"]) && count($folder["weeks"] > 0) )
	<li id={{$folder["id"]}} class="folder-item">
		<input type="checkbox" class="folder-checkbox" name = "package_folders[]" value = {{$folder["id"]}} data-folderid = {{$folder["id"]}} data-foldername = "{{$folder["label"]}}" > {{$folder["label"]}} 
		<ul>
			@foreach ($folder["weeks"]  as $week )
			<li class="folder" id = {{$week["global_id"]}}  data-isWeek = true>
				 <input type="checkbox" class="folder-checkbox" name = "package_folders[]" value = {{$week["global_id"]}} data-folderid = {{$week["global_id"]}} data-foldername = "{{"Week ". $week["week"]}}" >{{ "Week " . $week["week"] }}
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="folder-item" id={{$folder["id"]}} data-isWeek = false>

		<input type="checkbox" class="folder-checkbox" name = "package_folders[]" value = {{$folder["id"]}} data-folderid = {{$folder["id"]}} data-foldername = "{{$folder["label"]}}"> {{ $folder["label"] }} 

		<ul>
		</ul>
	</li>
@endif		