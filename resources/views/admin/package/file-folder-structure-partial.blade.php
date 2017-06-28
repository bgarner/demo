@if(count($nav["children"]) >0 )
	<li id={{$nav["id"]}} class="parent-folder"> {{$nav["label"]}} 
	@if(isset($nav["documents"]))
		@foreach($nav["documents"] as $doc)
			<br>
			<input class="document-checkbox" type="checkbox" name="package_files[]" value= {{$doc->id}} data-filename= "{{ $doc->original_filename }}" > <span class="document_name">{{$doc->original_filename}}</span>
		@endforeach
	@endif
	<ul>
	@foreach ($nav["children"] as $child)
	<?php $nav = $navigation[$child["child_id"]] ?>
	@include('admin.package.file-folder-structure-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($nav["weeks"]) && count($nav["weeks"] > 0) )
	<li id={{$nav["id"]}} class="parent-folder"> {{$nav["label"]}} 
		<ul>
			@foreach ($nav["weeks"]  as $week )
			<li class="folder" id = {{$week["global_id"]}}  data-isWeek = true> {{ "week " . $week["week"] }}
				@if(isset($navigation[$week["global_id"]]["documents"]))
					@foreach($navigation[$week["global_id"]]["documents"] as $doc)
						<br>
						<input class="document-checkbox" type="checkbox" name="package_files[]" value={{$doc->id}} data-filename = "{{ $doc->original_filename }}" >
						<span class="document_name">{{$doc->original_filename}}</span>
					@endforeach
				@endif
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="folder" id={{$nav["id"]}} data-isWeek = false>{{ $nav["label"] }}	 	
		@if(isset($nav["documents"]))
			@foreach($nav["documents"] as $doc)
				<br>
				<input class="document-checkbox" type="checkbox" name="package_files[]" value= {{$doc->id}} data-filename= "{{ $doc->original_filename }}" >  
				<span class="document_name">{{$doc->original_filename}}</span>
			@endforeach
		@endif
		<ul>
		</ul>
	</li>
@endif		