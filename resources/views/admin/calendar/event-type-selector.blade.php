<select class="form-control" id="event_type" name="event_type">
    @foreach($event_types_list as $key=>$event_type)

            <option value="{{ $key }}">{{ $event_type}}</option>

    @endforeach
</select>