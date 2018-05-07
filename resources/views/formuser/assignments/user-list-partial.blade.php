@if( isset($users) && count($users)> 0 )
	<div id="user_list">
	@foreach($users as $user)
	
	{{-- <div class="user-list-item">
				<input type="checkbox" class="user-checkbox" name = "form_user" value = "{{$user->id}}" data-userid = "{{$user->id}}"  > {{$user->firstname}} {{$user->lastname}} - {{$user->fglposition}} ( {{$user->role_name}} - {{$user->business_unit}} )
			</div> --}}


	<div class="vote-item">
        <div class="row">
            <div class="col-md-10">

                <div class="vote-title user-list-item">
                	<input type="checkbox" class="user-checkbox" name = "form_user" value = "{{$user->id}}" data-userid = "{{$user->id}}"  > 
                	<label> {{$user->firstname}} {{$user->lastname}} </label>
                    
                </div>
                <div class="vote-info">
                    <span class="user-position">
                    <i class="fa fa-id-card"></i> {{$user->fglposition}}
                    </span>
                    <span class="user-group">
                    <i class="fa fa-users"></i> {{$user->role_name}} -  {{$user->business_unit}}
                    </span>
                </div>
                
            </div>
            
        </div>
    </div>
	@endforeach
	</div>
@endif