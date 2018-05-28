@foreach($eventsList as $day=>$events)
<div class="timeline-item">

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 date">
            <i class="fa fa-calendar"></i> {{$events[0]->prettyDateStart}}
            <br>
            <small class="text-navy">
                @if( strtotime($events[0]->start) < strtotime(date("y-m-d H:i:s")) )
                    {!! $events[0]->since !!} {{ __("ago") }}
                @else
                    in {!! $events[0]->since !!}
                @endif
            </small>

        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 content">
            @foreach($events as $e)
            <div class="event row">
                <div class="event-type col-md-3 col-xs-12">
                    <span class="label" style="background-color: #{{$e->background_colour}}; color: #{{$e->foreground_colour}};">{!! $e->event_type_name !!}</span>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="event-title">

                        <span class="m-b-xs"><strong>{!! $e->title !!}</strong></span>
                    </div>
                    <div class="event-desc">
                        <p>{!! $e->description !!}</p>
                        @if( isset($communication->stores) )
                            @foreach($e->stores as $store)
                                <span class="badge">{{$store}}</span></a>
                            @endforeach
                        
                        @elseif( isset( $e->all_stores ) && ( $e->all_stores == 1 ) )
                            <span class="badge">{{$e->banner}}</span></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach
