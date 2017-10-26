<select class="form-control" id="event_type" name="event_type">
    @foreach($event_types_list as $key=>$event_type)

            @if(isset($event) && !empty($event))
            	@if( $key == $event->event_type )
                    <option value="{{ $key }}" selected>{{ $event_type}}</option>
                @else
                    <option value="{{ $key }}">{{ $event_type}}</option>
                @endif
			@else
				<option value="{{ $key }}">{{ $event_type}}</option>
			@endif


    @endforeach
</select>