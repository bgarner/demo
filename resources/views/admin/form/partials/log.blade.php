<div id="vertical-timeline" class="vertical-container light-timeline no-margins">
    @foreach($log as $logItem)

    <div class="vertical-timeline-block">
        <div class="vertical-timeline-icon {{ $logItem->log['status_colour'] }}">
            <i class="fa {{ $logItem->log['status_icon'] }}"></i>
        </div>

        <div class="vertical-timeline-content">
            <h2>{{$logItem->log['status_admin_name']}}</h2>

            @if($logItem->log['comment'])
            <i class="fa fa-quote-left" aria-hidden="true"></i>
            <p><em>{{ $logItem->log['comment'] }}</em></p>
            @endif

                <span class="">
                    <small>
                    {{ $logItem->log['user_name'] }} - {{ $logItem->log['user_position'] }}<br / />
                    <div class="pull-left">{{ $logItem->sinceSubmitted }} ago</div>
                    <div class="pull-right">{{ $logItem->prettySubmitted }}</div>
                    </small>
                </span>
        </div>
    </div>

    @endforeach

</div>