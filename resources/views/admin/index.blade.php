

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
<!-- 		                        <div class="ibox-title">
		                            <h5>Admin Home</h5>
		                            
		                        </div> -->
		                        <div class="ibox-content">

		                            <div class="m-b-lg">

		                            <h1>Overall Usage</h1>
		                            <h3>Last 24 Hours (Moutain Time)</h3>
									<div class="flot-chart dashboard-chart">
			                            <div class="flot-chart-content" id="flot-dashboard-day" style="padding: 0px; position: relative;"></div>
			                        </div>

		                            <h3>Last 30 Days</h3>
									<div class="flot-chart dashboard-chart">
			                            <div class="flot-chart-content" id="flot-dashboard-month" style="padding: 0px; position: relative;"></div>
			                        </div>


		            
		           

{{-- 
		                            @foreach($traffic as $key=>$day)
		                            	{{ $key }}
		                            	<h1>{{ count($day) }}</h1>
		                            	
		                            	@foreach($day as $d)
		                            		{{ $d->created_at }}<br/>
		                            	@endforeach
		                            	<hr />
		                            	

		                            @endforeach
--}}
		                            </div>


		                            @if( count($urgentNoticeStats) > 0 )
		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<h2>Urgent Notices <small>(Current)</small></h2>
		                            		@foreach($urgentNoticeStats as $notice)
		                            			{{ $notice->title }}
		                            		@endforeach

		                            	</div>
		                            </div>
		                            @endif

		                            <div class="row">
		                            	<div class="col-md-12">
		                            	<h2>Communications <small>(Last 7 Days)</small></h2>
		                            	<!-- 	<canvas id="doughnutChart" width="35" height="35" style="width: 35px; height: 35px;"></canvas> -->
		                            	
		                         <!--    	<canvas id="doughnutChart" width="35" height="35" style="width: 35px; height: 35px;"></canvas> -->
		      							<table class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
		      								<th>
		      									<td>Subject</td>
		      									<td>Sent At</td>
                                                <td>Read</td>
		      								</th>
		      								@foreach($commStats as $comm)
		      								<tr>
		      									<td>
		      										@if($comm->banner_id == 1)
		      											<small class="label label-sm label-inverse">SC</small>&nbsp;&nbsp;
		      										@else 
		      											<small class="label label-sm label-warning">Atmo</small>&nbsp;&nbsp;
		      										@endif
		      									</td>
		      									<td><a href="/admin/communication/{{ $comm->id }}/edit">{{ $comm->subject }}</a> 
                                                <span class="label label-sm label-{{ $comm->colour }}">{{ $comm->communication_type }}</span></td>
		      									<td>{{ $comm->send_at }}</td>
		      									<td>
                       {{--                          <small>
                                                    {{ $comm->openCount }} of {{ $comm->storeCount }} ( {{ $comm->readPerc }}% )
                                                </small> --}}
                                                    <canvas id="commChart_{{ $comm->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                                </td>
		      								</tr>
		      								@endforeach

		      							</table>

		                            	</div>
		                            </div>

		                            </div>


{{-- 
		                            <div class="row">
		                            	<div class="col-md-6">
		                            	<h2>Most Popular Files</h2>
		                            		
		      

		                            	</div>
		                            	<div class="col-md-6">
		                            	<h2>Most Active Stores</h2>

		                            	</div>
		                            </div>	 --}}	                            

		                        </div>

		                    </div>
		                </div>
		            </div>


		        </div>

				@include('site.includes.footer')

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

 $(document).ready(function() {
            // setTimeout(function() {
            //     toastr.options = {
            //         closeButton: true,
            //         progressBar: true,
            //         showMethod: 'slideDown',
            //         timeOut: 4000
            //     };
            //     toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            // }, 1300);



            var data1 = [
            	<?php $i=1; ?>
            	@foreach($traffic as $key=>$day)
            		[{{ $i++ }}, {{ count($day) }}],
				@endforeach
            ];

            var data2 = [
            	<?php $i=1; ?>
            	@foreach($trafficDaily as $key=>$day)
            		[{{ $i++ }}, {{ count($day) }}],
				@endforeach
            ];            

            $("#flot-dashboard-month").length && $.plot($("#flot-dashboard-month"), [
                data1
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
			          	xaxis: {
			    			ticks: 
			    			<?php $i=0; ?>
			    			[
            				@foreach($traffic as $key=>$day)
            					<?php $i++; ?>
            					@if ($i % 2 == 0) 
            					[{{ $i }}, "{{ $key }}"],
            					@else
            					[" ", ""],
            					@endif
			    			@endforeach
			    			]
							},
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

			$("#flot-dashboard-day").length && $.plot($("#flot-dashboard-day"), [
			                data2
			            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1C84C6", "#1C84C6"],
			          	xaxis: {
			    			ticks: 
			    			<?php $i=0; ?>
			    			[
            				@foreach($trafficDaily as $key=>$day)
            					<?php $i++; ?>
            					@if ($i % 2 == 0) 
            					[{{ $i }}, "{{ $key }}"],
            					@else
            					[" ", ""],
            					@endif
			    			@endforeach
			    			]
							},
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );   


            function addText(id,text) {

              var canvas = document.getElementById(id);
              var ctx = document.getElementById(id).getContext("2d");

              var cx = canvas.width / 2;
              var cy = canvas.height / 2;

              console.log(cx, cy); 

              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';
              ctx.font = '14px verdana';
              ctx.fillStyle = 'black';
              ctx.fillText(text, cx, cy);

            }

            // var doughnutOptions = {
            //     segmentShowStroke: true,
            //     segmentStrokeColor: "#fff",
            //     segmentStrokeWidth: 2,
            //     percentageInnerCutout: 50, // This is 0 for Pie charts
            //     animationSteps: 100,
            //     animationEasing: "easeOutBounce",
            //     animateRotate: true,
            //     animateScale: false,
            //     showTooltips: false,
            //     onAnimationComplete: addText
            // };            

            @foreach($commStats as $c)
                var commData_{{$c->id}} = [
                    {
                        value: {{ $c->openCount }},
                        color: "#ee0000",
                        //color: "#a3e1d4",
                        highlight: "#1ab394"
               
                    },
                    {
                        value: {{ $c->unreadCount }},
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

            // var doughnutData = [
            //     {
            //         value: 200,
            //         color: "#a3e1d4",
            //         highlight: "#1ab394",
            //         label: "App"
            //     },
            //     {
            //         value: 22,
            //         color: "#dedede",
            //         highlight: "#1ab394",
            //         label: "Software"
            //     },
        
            // ];


            // var doughnutData2 = [
            //     {
            //         value: 100,
            //         color: "#a3e1d4",
            //         highlight: "#1ab394",
            //         label: "App"
            //     },
            //     {
            //         value: 122,
            //         color: "#dedede",
            //         highlight: "#1ab394",
            //         label: "Software"
            //     },
        
            // ];            



            // var ctx = document.getElementById("doughnutChart").getContext("2d");
            // var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            // var ctx = document.getElementById("doughnutChart2").getContext("2d");
            // var DoughnutChart2 = new Chart(ctx).Doughnut(doughnutData2, doughnutOptions);




        });					

				</script>

				@include('site.includes.bugreport')



			</body>
			</html>


