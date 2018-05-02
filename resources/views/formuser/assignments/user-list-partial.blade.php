@if( isset($users) && count($users)> 0 )
	<div id="user_list">
	@foreach($users as $user)
	
	<div class="user-list-item">
		<input type="checkbox" class="user-checkbox" name = "form_user" value = "{{$user->id}}" data-userid = "{{$user->id}}"  > {{$user->firstname}} {{$user->lastname}} - {{$user->fglposition}} ( {{$user->role_name}} - {{$user->business_unit}} )
	</div>
	@endforeach
	</div>
@endif