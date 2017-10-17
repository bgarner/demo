<div class="btn-group">
	<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="selected_comm_type">Select</span>
		<i class="fa fa-angle-down"></i>
	</a>
	<input type="text" hidden  name="communication_type" value="">
	<ul name="communication_type" id="" class="dropdown-menu" role="menu">
		@foreach($communicationTypes as $ct)

			@if( $ct->id == 1 || $ct->id == 2)
				<li data-comm-typeid="{{$ct->id}}"
					data-comm-type="{{$ct->communication_type}}"
					data-comm-typecolour="{{$ct->colour}}"
					class="comm_type_dropdown_item" >
					<a href="#"> {{$ct->communication_type}} </a>
				</li>
			@else
				<li data-comm-typeid="{{$ct->id}}"
					data-comm-type="{{$ct->communication_type}}"
					data-comm-typecolour="{{$ct->colour}}"
					class="comm_type_dropdown_item" >
					<a href="#" ><i class="fa fa-circle text-{{$ct->colour}}"></i> {{$ct->communication_type}}</a>
				</li>
			@endif

		@endforeach
	</ul>
</div>