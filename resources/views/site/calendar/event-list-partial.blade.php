@foreach($eventsList as $day=>$events)
<div class="timeline-item">

    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4 date">
            <i class="fa fa-calendar"></i>
            
            {{$events[0]->prettyDateStart}}
            <br>
            <small class="text-navy">
            @if( strtotime($events[0]->start) < strtotime(date("y-m-d H:i:s")) )
                {!! $events[0]->since !!} ago
            @else 
                in {!! $events[0]->since !!} 
            @endif
            
            </small>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8 content">
            @foreach($events as $e)
            <div class="event row">
                <div class="event-type col-md-3">
                    <span class="label label-primary">{!! $e->event_type_name !!}</span>
                </div>
                <div class="col-md-9">
                    <div class="event-title">
                        
                        <span class="m-b-xs"><strong>{!! $e->title !!}</strong></span>
                    </div>
                    <div class="event-desc">
                        <p>{!! $e->description !!}</p>
                    </div>
                </div>
            </div>    
            @endforeach
        </div>
    </div>
</div>
@endforeach