@if( isset($groups) && count($groups)> 0 )
	<div id="group_list">
	@foreach($groups as $group)
	
	{{-- <div class="group-list-item">
				<input type="checkbox" class="group-checkbox" name = "form_group" value = "{{$group->id}}" data-groupid = "{{$group->id}}"  > {{$group->group_name}} 
			</div> --}}


	<div class="vote-item">
        <div class="row">
            <div class="col-md-10">

                <div class="vote-title group-list-item">
                	<input type="checkbox" class="group-checkbox" name = "form_group" value = "{{$group->id}}" data-groupid = "{{$group->id}}"  >
                	<label> {{$group->group_name}}  </label>
                    
                </div>
				{{-- <div class="vote-info">
                    <span class="user-position">
                    <i class="fa fa-id-card"></i> 
                    </span>
                    <span class="user-group">
                    <i class="fa fa-users"></i>
                    </span>
                </div> --}}
                
            </div>
            
        </div>
    </div>


	@endforeach
	</div>
@endif