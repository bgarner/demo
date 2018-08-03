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
        tr{
            cursor: pointer;
        }
        .pagination_link{
            cursor: pointer;
        }
        .pagination{
            display: table;
            margin: 0 auto;
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


        <div class="row wrapper border-bottom white-bg">
            <div class="col-lg-12">
                <h2>Admin Home</h2>
                <ol class="breadcrumb">
                    <li>
                        Last Updated : {{$prettyLastCompiledTimestamp}}
                    </li>

                </ol>
                <br />
            </div>
        </div>

        <div class="wrapper wrapper-content  animated fadeInRight printable">
            <div class="row">
                <div class="col-lg-12">

                    
                    @include('admin.analytics.communication-analytics-partial')
                    @include('admin.analytics.urgentnotice-analytics-partial')
                    @include('admin.analytics.task-analytics-partial')
                    @include('admin.analytics.video-analytics-partial')
                    </div>

                    </div>
                </div>
            </div>

    </div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')
    <script>

    </script>
    <!-- Flot -->
    <script type="text/javascript" src="/js/plugins/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="/js/plugins/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="/js/plugins/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
    <script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
    <script type="text/javascript" src="/js/custom/admin/analytics/analytics.js"></script>
    <script type="text/javascript" src="/js/custom/admin/analytics/videoReport.js"></script>
    <script type="text/javascript" src="/js/custom/admin/dashboard/getStoreDetails.js"></script>

   	<!-- ChartJS-->
	<script type="text/javascript" src="/js/plugins/chartJs/Chart.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){



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

            @if($videoStats)
            @foreach($videoStats as $c)
                var videoData_{{$c['id']}} = [
                    {
                        value: {{ $c['opened_total'] }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"

                    },
                    {
                        value: {{ $c['unopened_total'] }},
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ];

               var ctx = document.getElementById("videoChart_{{ $c['id'] }}").getContext("2d");
               var videoChart_{{ $c['id'] }} = new Chart(ctx).Doughnut(videoData_{{ $c['id'] }}, {
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

                          var canvas = document.getElementById("videoChart_{{ $c['id'] }}");
                          var ctx = document.getElementById("videoChart_{{ $c['id'] }}").getContext("2d");

                          var cx = canvas.width / 2;
                          var cy = canvas.height / 2;

                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'middle';
                          ctx.font = '10px arial';
                          ctx.fillStyle = '#333333';
                          ctx.fillText("{{ $c['readPerc'] }}%", cx, cy);

                      }


                 });
            @endforeach
            @endif

        });
        
    </script>

	@include('site.includes.bugreport')

    </body>
</html>
