<!DOCTYPE html>
<html>

<head>
    @section('title', 'Admin Home')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
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
                <div class="col-lg-10">
                    <h2>Admin Home</h2>
                    <ol class="breadcrumb">

                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

        <div class="wrapper wrapper-content  animated fadeInRight printable">
            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Communications <small>(Last 7 Days)</small></h2>
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
                                            <td data-read-perc = {{$comm->readPerc}}>
                                            
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
                            <h2>Urgent Notice <small>(Last 7 Days)</small></h2>
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
                                            <td data-read-perc = {{$urgentNotice->readPerc}}>
                                            
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
                                        <tr class="task-details-control">
                                            <td>
                                                @if($task->banner_id == 1)
                                                    <small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
                                                @else 
                                                    <small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
                                                @endif
                                            </td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->due_date }}</td>
                                            <td data-read-perc = {{$task->readPerc}}>
                                            
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

                        <div class="ibox">
                        <div class="ibox-title">
                            <h2>Videos</h2>
                            <div class="ibox-tools">
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
                                                <th>Due Date</th>
                                                <th>Completed</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($videoStats as $video)
                                        <tr class="task-details-control">
                                            <td>
                                                @if($video->banner_id == 1)
                                                    <small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
                                                @else 
                                                    <small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
                                                @endif
                                            </td>
                                            <td>{{ $video->title }}</td>
                                            <td>{{ $video->due_date }}</td>
                                            <td data-read-perc = {{$video->readPerc}}>
                                            
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
                   null,
                   {'width': '40%'},
                   null,null,
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


            function format ( d ) {
                // `d` is the original data object for the row
                
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                        '<td>Opened by Stores:</td>'+
                        '<td>'+ JSON.parse(d[4])+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Not Opened by Stores:</td>'+
                        '<td>'+JSON.parse(d[5])+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Sent to Stores</td>'+
                        '<td>'+ JSON.parse(d[6]) +'</td>'+
                    '</tr>'+
                '</table>';
            }


        });

    </script>


	@include('site.includes.bugreport')



    </body>
</html>


