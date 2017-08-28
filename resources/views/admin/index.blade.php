<!DOCTYPE html>
<html>

<head>
    @section('title', 'Admin Home')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <style>
        
        .store{
            /*border:thin solid lime;*/
            padding: 0px 5px;
            cursor: pointer;
            margin: 0px 5px;
            display: inline-block;
            width:50px;
            text-align: center;
        }
        .active-store{
            background-color: green;
            border-color: green;
            color: #ffffff;
        }
        .modal-dialog{
            height: 280px;
        }
        .modal-body{
            padding:50px 30px 30px 30px;
        }
        /*.overdue_task{
            background-color: rgb(230, 230, 230);
        }*/
        .overdue_task i{
            color: #ee0101;
        }
    </style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>
	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div >
                    <h2>Admin Home</h2>
                </div>
                <div>
                    <small class="pull-right"> Last Updated : {{$prettyLastCompiledTimestamp}} </small>
                </div>
		</div>

        <div class="wrapper wrapper-content  animated fadeInRight printable">
            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Communications <small>(Last 30 Days)</small></h2>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                    
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <table class="table table-stripped" id="communication_analytics">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Subject</th>
                                                <th>Sent At</th>
                                                <th>Read</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($commStats as $comm)
                                        <tr class="details-control">
                                            <td>
                                                @if($comm->banner_id == 1)
                                                    <small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
                                                @else 
                                                    <small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
                                                @endif
                                            </td>
                                            <td>{{ $comm->subject }}
                                            <span class="label label-sm label-{{ $comm->colour }}">{{ $comm->communication_type }}</span></td>
                                            <td>{{ $comm->send_at }}</td>
                                            <td data-order="{{$comm->readPerc}}" data-read-perc = {{$comm->readPerc}}>
                                            
                                                <canvas id="commChart_{{ $comm->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                            </td>
                                            <td >{{$comm->opened}}</td>
                                            <td >{{$comm->unopened}}</td>
                                            <td >{{$comm->sent_to}}</td>
                                        </tr>
                                        
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Urgent Notice <small>(Last 30 Days)</small></h2>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">


                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <table class="table table-stripped" id="urgent_notice_analytics">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Subject</th>
                                                <th>Sent At</th>
                                                <th>Read</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($urgentNoticeStats as $urgentNotice)
                                        <tr class="un-details-control">
                                            <td>
                                                @if($urgentNotice->banner_id == 1)
                                                    <small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
                                                @else 
                                                    <small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
                                                @endif
                                            </td>
                                            <td>{{ $urgentNotice->title }}</td>
                                            <td>{{ $urgentNotice->start }}</td>
                                            <td data-order="{{$urgentNotice->readPerc}}" data-read-perc = {{$urgentNotice->readPerc}}>
                                            
                                                <canvas id="urgentNoticeChart_{{ $urgentNotice->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                            </td>
                                            <td >{{$urgentNotice->opened}}</td>
                                            <td >{{$urgentNotice->unopened}}</td>
                                            <td >{{$urgentNotice->sent_to}}</td>
                                        </tr>
                                        
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Tasks</h2>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">


                            <div class="row">
                                <div class="col-md-12">
                                   
                                    
                                    <table class="table table-stripped" id="task_analytics">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Due Date</th>
                                                <th>Completed</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($taskStats as $task) 
                                            @if( $task->due_date < $today)
                                                <tr class="task-details-control overdue_task">
                                            @else
                                                <tr class="task-details-control">
                                            @endif
                                                <td>
                                                    @if($task->banner_id == 1)
                                                        <small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
                                                    @else 
                                                        <small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
                                                    @endif
                                                </td>
                                                <td>{{ $task->title }}</td>
                                                <td class="faa-parent animated-hover">
                                                    
                                                    @if( $task->due_date < $today)
                                                        <i class="fa fa-bell-o faa-shake"></i>
                                                    @endif
                                                    {{ $task->due_date }}

                                                </td>
                                                <td data-order="{{$task->readPerc}}" data-read-perc = {{$task->readPerc}}>
                                                
                                                    <canvas id="taskChart_{{ $task->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                                </td>
                                                <td >{{$task->opened}}</td>
                                                <td >{{$task->unopened}}</td>
                                                <td >{{$task->sent_to}}</td>
                                            </tr>
                                        
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- <div class="ibox">
                        <div class="ibox-title">
                            <h2>Videos</h2>
                            <div class="ibox-tools">
                                <a class="btn btn-xs" id="videoReportModal">View Report by Date</a>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-stripped" id="video_analytics">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Thumbnail</th>
                                                <th>Seen</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($videoStats as $video)
                                        <tr class="video-details-control">
                                            <td></td>
                                            <td>{{ $video->title }}</td>
                                            <td><img src="/video/thumbs/{{$video->thumbnail}}" style="width: 35%" /></td>
                                            <td data-order="{{$video->readPerc}}" data-read-perc = {{$video->readPerc}}>
                                            
                                                <canvas id="videoChart_{{ $video->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                            </td>
                                            <td >{{$video->opened}}</td>
                                            <td >{{$video->unopened}}</td>
                                            <td >{{$video->sent_to}}</td>
                                        </tr>
                                        
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                        

                    </div> --}}

                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Videos</h2>
                            <div class="ibox-tools">
                                <!-- <a class="btn btn-xs" id="videoReportModal">View Report by Date</a> -->
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Analytics by Videos </a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Analytics by Store</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <table class="table table-stripped" id="video_analytics">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Title</th>
                                                                <th>Thumbnail</th>
                                                                <th>Seen</th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($videoStats as $video)
                                                        <tr class="video-details-control">
                                                            <td></td>
                                                            <td>{{ $video->title }}</td>
                                                            <td><img src="/video/thumbs/{{$video->thumbnail}}" style="width: 35%" /></td>
                                                            <td data-order="{{$video->readPerc}}" data-read-perc = {{$video->readPerc}}>
                                                            
                                                                <canvas id="videoChart_{{ $video->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                                            </td>
                                                            <td >{{$video->opened}}</td>
                                                            <td >{{$video->unopened}}</td>
                                                            <td >{{$video->sent_to}}</td>
                                                        </tr>
                                                        
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Start &amp; End</label>

                                                    <div class="col-sm-6">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <input type="text" class="input-sm form-control datetimepicker-start" name="start_date" id="start_date" value="" />
                                                            <span class="input-group-addon">to</span>
                                                            <input type="text" class="input-sm form-control datetimepicker-end" name="end_date" id="end_date" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a class="btn btn-default" id="generateVideoReport">Get Report  </a>
                                                        <a class="btn btn-default hidden" id="downloadVideoReport">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="text" id="reportJson" class="hidden">
                                                <table class="table table-stripped hidden" id="video_analytics_by_store">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Store Number</th>
                                                            <th>Total Videos Seen</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div><!-- ibox content closes -->

                    </div><!-- ibox closes -->
                    </div>

                    </div>
                </div>
            </div>

    </div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')

    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/js/plugins/flot/jquery.flot.pie.js"></script>	
    <script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
    <script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
    <script type="text/javascript" src="/js/custom/admin/analytics/videoReport.js"></script>	
    
   	<!-- ChartJS-->
	<script src="/js/plugins/chartJs/Chart.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            var table = $('#communication_analytics').DataTable({
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [    
                   null,
                   {'width': '40%'},
                   null,null,
                   {"visible": false},
                   {"visible": false},
                   {"visible": false}
                 ],
                 "searching": false
            });

            var urgentNoticeTable = $('#urgent_notice_analytics').DataTable({
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [    
                   null,
                   {'width': '40%'},
                   null,null,
                   {"visible": false},
                   {"visible": false},
                   {"visible": false}
                 ],
                 "searching": false
            });

            var taskTable = $('#task_analytics').DataTable({
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [    
                   null,
                   {'width': '40%'},
                   null,null,
                   {"visible": false},
                   {"visible": false},
                   {"visible": false}
                 ],
                 "searching": false
            });

            var videoTable = $('#video_analytics').DataTable({
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [    
                   {"visible": false},
                   {'width': '40%'},
                   {'width': '40%'},
                   null,
                   {"visible": false},
                   {"visible": false},
                   {"visible": false}
                 ],
                 "searching": false
            });


            

            @foreach($commStats as $c)
                var commData_{{$c->id}} = [
                    {
                        value: {{ $c->opened_total }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"
               
                    },
                    {
                        value: {{ $c->unopened_total }},
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ];

               var ctx = document.getElementById("commChart_{{ $c->id }}").getContext("2d");
               var commChart_{{ $c->id }} = new Chart(ctx).Doughnut(commData_{{ $c->id }}, { 
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 70, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    showTooltips: false,
                    onAnimationComplete: function(){

                          var canvas = document.getElementById("commChart_{{ $c->id }}");
                          var ctx = document.getElementById("commChart_{{ $c->id }}").getContext("2d");

                          var cx = canvas.width / 2;
                          var cy = canvas.height / 2;

                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'middle';
                          ctx.font = '10px arial';
                          ctx.fillStyle = '#333333';
                          ctx.fillText("{{ $c->readPerc }}%", cx, cy);

                      }
                      
      
                 });
            @endforeach 

            @foreach($urgentNoticeStats as $c)
                var urgentNoticeData_{{$c->id}} = [
                    {
                        value: {{ $c->opened_total }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"
               
                    },
                    {
                        value: {{ $c->unopened_total }},
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ];

               var ctx = document.getElementById("urgentNoticeChart_{{ $c->id }}").getContext("2d");
               var urgentNoticeChart_{{ $c->id }} = new Chart(ctx).Doughnut(urgentNoticeData_{{ $c->id }}, { 
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 70, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    showTooltips: false,
                    onAnimationComplete: function(){

                          var canvas = document.getElementById("urgentNoticeChart_{{ $c->id }}");
                          var ctx = document.getElementById("urgentNoticeChart_{{ $c->id }}").getContext("2d");

                          var cx = canvas.width / 2;
                          var cy = canvas.height / 2;

                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'middle';
                          ctx.font = '10px arial';
                          ctx.fillStyle = '#333333';
                          ctx.fillText("{{ $c->readPerc }}%", cx, cy);

                      }
                      
      
                 });
            @endforeach

            @foreach($taskStats as $c)
                var taskData_{{$c->id}} = [
                    {
                        value: {{ $c->opened_total }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"
               
                    },
                    {
                        value: {{ $c->unopened_total }},
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ];

               var ctx = document.getElementById("taskChart_{{ $c->id }}").getContext("2d");
               var taskChart_{{ $c->id }} = new Chart(ctx).Doughnut(taskData_{{ $c->id }}, { 
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 70, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    showTooltips: false,
                    onAnimationComplete: function(){

                          var canvas = document.getElementById("taskChart_{{ $c->id }}");
                          var ctx = document.getElementById("taskChart_{{ $c->id }}").getContext("2d");

                          var cx = canvas.width / 2;
                          var cy = canvas.height / 2;

                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'middle';
                          ctx.font = '10px arial';
                          ctx.fillStyle = '#333333';
                          ctx.fillText("{{ $c->readPerc }}%", cx, cy);

                      }
                      
      
                 });
            @endforeach


            @foreach($videoStats as $c)
                var videoData_{{$c->id}} = [
                    {
                        value: {{ $c->opened_total }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"
               
                    },
                    {
                        value: {{ $c->unopened_total }},
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ];

               var ctx = document.getElementById("videoChart_{{ $c->id }}").getContext("2d");
               var videoChart_{{ $c->id }} = new Chart(ctx).Doughnut(videoData_{{ $c->id }}, { 
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 70, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    showTooltips: false,
                    onAnimationComplete: function(){

                          var canvas = document.getElementById("videoChart_{{ $c->id }}");
                          var ctx = document.getElementById("videoChart_{{ $c->id }}").getContext("2d");

                          var cx = canvas.width / 2;
                          var cy = canvas.height / 2;

                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'middle';
                          ctx.font = '10px arial';
                          ctx.fillStyle = '#333333';
                          ctx.fillText("{{ $c->readPerc }}%", cx, cy);

                      }
                      
      
                 });
            @endforeach

            $('#communication_analytics tbody').on('click', 'tr.details-control', function () {
                var tr = $(this);
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

            $('#urgent_notice_analytics tbody').on('click', 'tr.un-details-control', function () {
                var tr = $(this);
                var row = urgentNoticeTable.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );


            $('#task_analytics tbody').on('click', 'tr.task-details-control', function () {
                var tr = $(this);
                var row = taskTable.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

            $('#video_analytics tbody').on('click', 'tr.video-details-control', function () {
                var tr = $(this);
                var row = videoTable.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );


            function format ( d ) {
                
                // `d` is the original data object for the row

                var opened = JSON.parse(d[4]);
                var sent_to = JSON.parse(d[6]);
                var sent_to_stores = getStoresString(sent_to, opened);

                return '<tr>'+
                            '<td>'+sent_to_stores+'</td>'+
                        '</tr>';
            }


            function getStoresString(sent_to, opened){
                var returnString = '<td>';
                $.each( sent_to, function( key, value ) { 
                    if($.inArray(value, opened) >= 0){
                        returnString += '<span class="store btn btn-xs active-store">'+value+'</span>';
                    }
                    else{
                        returnString += '<span class="store btn btn-xs btn-default">'+value+'</span>';   
                    }

                });

                returnString += '</td>';

                return returnString;
            }


        });

    </script>

	@include('site.includes.bugreport')

    </body>
</html>