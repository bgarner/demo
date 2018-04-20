@if( isset($groups) && count($groups)> 0 )
	@foreach($groups as $group)
	
	<div class="group-list-item">
		<input type="checkbox" class="group-checkbox" name = "form_group" value = "{{$group->id}}" data-groupid = "{{$group->id}}"  > {{$group->group_name}} 
	</div>
	@endforeach
@endif