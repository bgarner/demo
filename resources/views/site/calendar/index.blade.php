<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>{{ __("Workload Calendar") }}</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>


                    <div class="tabs-container wrapper wrapper-content animated fadeInRight">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">{{ __("Calendar View") }}</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">{{ __("List View") }}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="ibox-content">
                                        <div id="calendar"></div>
                                    </div>

                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">




                                  <div class="ibox-content inspinia-timeline printable" style="display: block;">

                                <div class="fc-toolbar">
                                    <div class="fc-left">
                                        <div class="fc-button-group">
                                            <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left prev-month">
                                                <span class="fc-icon fc-icon-left-single-arrow"></span>
                                            </button>
                                            <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right next-month">
                                                <span class="fc-icon fc-icon-right-single-arrow"></span>
                                            </button>
                                        </div>

                                        <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right go-to-today">{{__("today")}}</button>
                                    </div>



                                    <div class="fc-center"><h2><span class="month-name"></span> <span class="year"></span></h2></div>
                                    <div class="fc-clear"></div>
                                </div>
                                <div class="event-list-partial">
                                    @include('site.calendar.event-list-partial', ['eventList'=> $eventsList])
                                </div>

                                        {{--@foreach($eventsList as $e)
                                        <div class="timeline-item">

                                            <div class="row">
                                                <div class="col-xs-4 date">
                                                    <i class="fa fa-calendar"></i>
                                                    {!! $e->prettyDateStart !!}
                                                    <br>
                                                    <small class="text-navy">
                                                    @if( strtotime($e->start) < strtotime(date("y-m-d H:i:s")) )
                                                        {!! $e->since !!} ago
                                                    @else
                                                        in {!! $e->since !!}
                                                    @endif

                                                    </small>
                                                </div>
                                                <div class="col-xs-8 content">
                                                    <span class="label label-primary">{!! $e->event_type_name !!}</span>
                                                    <p class="m-b-xs"><strong>{!! $e->title !!}</strong></p>
                                                    <p>{!! $e->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


{{--
         <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">
                                <div id="calendar"></div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
--}}


    @include('site.includes.footer')
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/custom/site/calendar/listViewUtils.js"></script>
    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    <script type="text/javascript" src="/js/plugins/fullcalendar/fullcalendar.min.js"></script>

    <script type="text/javascript">
    $(function() { // document ready

        var today = String("{!! $today !!}");
        setMonthDigits( today );
        setMonthName( today );
        setYear( today );

        var init_m = pad(the_month, 2);
        var init_yearMonth = the_year + '-' + init_m;
        getCurrentMonth( init_yearMonth );

        // $('.month-name').html( the_month_name);
        // $('.year').html(the_year);

        $( ".prev-month" ).click(function() {
            var m = parseInt(the_month, 10);
            m = m - 1;
            m = pad(m, 2);
            var yearMonth = the_year + '-' + m;
            renderList( getPrevMonth(yearMonth) );

        });

        $( ".next-month" ).click(function() {
            var m = parseInt(the_month, 10);
            m = m + 1;
            m = pad(m, 2);
            var yearMonth = the_year + '-' + m;
            renderList( getNextMonth(yearMonth) );
        });

        $('.go-to-today').click(function() {
            getCurrentMonth(init_yearMonth);
        });

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        var today = y + "-" + m + "-" + d;

        $('#calendar').fullCalendar({
            eventStartEditable: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,list'
            },
            defaultDate: today,
            editable: true,
            eventDurationEditable: false,
            eventLimit: true, // allow "more" link when too many events
            eventClick:  function(event, jsEvent, view) {
                console.log(event);
                $('#modalTitle').html("<span class='event-title pull-left'>" + event.title +"</span>");
                $('#modalTitle').append("<span class='event-span pull-right'>" + event.prettyStart+ " to " + event.prettyEnd + "</span>");
                $('#modalBody').html(event.description);
                $("#modalBody").append(event.attachment);
                $('#fullCalModal').modal();
            },
            events: [
                @foreach($events as $event)
                {
                    title: "{{ $event->title }}",
                    start: "{{ $event->start }}",
                    end: "{{ $event->end }}",
                    backgroundColor: "#{{ $event->background_colour }}",
                    borderColor: "#{{ $event->background_colour }}",
                    textColor: "#{{ $event->foreground_colour }}",
                    description : '{!! $event->description !!}',
                    prettyStart : "{{$event->prettyDateStart}}",
                    prettyEnd : "{{$event->prettyDateEnd}}",
                    attachment : "{!!$event->attachment!!}",
                },
                @endforeach
            ]
        });
    });
    </script>

    @include('site.includes.modal')

</body>
</html>
