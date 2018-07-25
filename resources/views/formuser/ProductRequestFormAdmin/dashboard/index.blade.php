<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
            .modal-dialog{
                height: 380px;
            }
            .bignumber{
                font-size: 72px;
                text-align: center;
                letter-spacing: -3px;
                font-weight: bold;
                margin: 0; padding: 0;
                min-height: 72px;
            }
            .bignumber-ttc{
                font-size: 60px;
                font-weight: bold;
                min-height: 80px;
            }
            .stat-percent{
                font-size: 36px;
            }
            .perc-box{
                width: 100%; 
                padding: 5px 10px 15px 10px;
                min-height: 60px;
            }
        </style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('formuser.includes.sidenav')
	        </div>
	    </nav>

		<div id="page-wrapper" class="gray-bg" >

			<div class="wrapper wrapper-content  animated fadeInRight">
	            <div class="row">
	                <div class="col-lg-12">
						
						<h2>Product Request</h2>

						<div class="wrapper wrapper-content animated fadeInRight">

				            <div class="row">
				                    <div class="col-lg-3">
				                        <div class="ibox float-e-margins">
				                            <div class="ibox-title">
				                                {{--  <span class="label label-success pull-right">New Forms</span>  --}}
				                                <h5>New Requests</h5>
				                            </div>
				                            <div class="ibox-content">
				                                <h1 class="no-margins bignumber">{{$analytics["totalNewFormsInLastWeek"]}}</h1>
				                            </div>
				                                <div class="perc-box" style="background-color: #cddcf4; ">
				                                    <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-level-up"></i></div> -->
				                                    <small>This Week<br />({{$analytics['start']}} - {{$analytics['end']}})</small>
				                                </div>
				                        </div>
				                    </div>

				                    <div class="col-lg-3">
				                        <div class="ibox float-e-margins">
				                            <div class="ibox-title">
				                                {{--  <span class="label label-info pull-right">In Progress</span>  --}}
				                                <h5>In Progress</h5>
				                            </div>
				                            <div class="ibox-content">
				                                <h1 class="no-margins bignumber">{{$analytics["totalInProgressForms"]}}</h1>
				                            </div>  
				                                <div class="perc-box" style="background-color: #d9f9f5;">
				                                	@if(isset($analytics["oldestInProgressSince"]))
				                                    <div class="stat-percent font-bold text-info">{{$analytics["oldestInProgressSince"]}} days</div>
				                                    <small>Oldest Request:</small>   
				                                    @endif
				                                     
				                                </div>
				                            </div>
				                    </div>
				                        
				                    

				                    <div class="col-lg-3">
				                        <div class="ibox float-e-margins">
				                            <div class="ibox-title">
				                                <span class="label label-primary pull-right"></span>
				                                <h5>Closed</h5>
				                            </div>
				                            <div class="ibox-content">
				                                <h1 class="no-margins bignumber">{{$analytics["totalClosedFormsInLastWeek"]}}</h1>
				                            </div>

				                                <div class="perc-box" style="background-color: #f9f5d9;">
				                                    <!-- <div class="stat-percent font-bold text-yellow">44% <i class="fa fa-level-up"></i></div> -->
				                                    <small>This Week<br />({{$analytics['start']}} - {{$analytics['end']}})</small>
				                                    
				                                </div>
				                            
				                        </div>
				                    </div>




				                    <div class="col-lg-3">
				                        <div class="ibox float-e-margins">
				                            <div class="ibox-title">
				                                {{--  <span class="label label-danger pull-right">Average</span>  --}}
				                                <h5>Avg Time to Close</h5>
				                            </div>
				                            <div class="ibox-content">
				                                <h1 class="no-margins bignumber-ttc">{{$analytics["avgTimeToCloseTicketLastWeek"]}} <small>hrs</small></h1>
				                                
				                            </div>
				                            
				                            <div class="perc-box" style="background-color: #f9dad9;">
				                                <!-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> -->
				                                <small>This Week<br />({{$analytics['start']}} - {{$analytics['end']}})</small>
				                            </div>
				                        </div>
				                    </div>
				                </div>
						</div>


	                    <div class="ibox">
	                        
	                        <div class="ibox-content">
								<div class="tabs-container">
			                        <ul class="nav nav-tabs">
										
			                        	@foreach($forms as $formCategory => $formInstances)
			                            
			                            <li  @if ($loop->first) class="active" @endif><a data-toggle="tab" href="#tab-{{$loop->iteration}}" aria-expanded="false">{{$formCategory}}</a></li>

			                            @endforeach
			                        </ul>
			                        <div class="tab-content">
			                        	@foreach($forms as $formCategory => $formInstances)

			                            <div id="tab-{{$loop->iteration}}" class="tab-pane @if ($loop->first) active @endif">
			                                <div class="panel-body">
			                                    <table class="table">
			                                    	<thead>
			                                    		
			                                    		<th>Description</th>
			                                    		<th>Store#</th>
			                                    		<th>Submitted At</th>
			                                    		<th>User Assigned To</th>
			                                    		<th>Group Assigned To</th>
			                                    		<th>Last Action</th>
			                                    	</thead>
			                                    	<tbody>
			                                    		@foreach($formInstances as $formInstance)
			                                    		<tr>
			                                    			
			                                    			<td><a href="/form/productrequest/{{$formInstance->id}}">{{$formInstance->description}}</a></td>
															<td>{{$formInstance->store_number}}</td>
															<td data-sort="{{$formInstance->created_at}}">{{$formInstance->prettySubmitted}}</td>
															<td class="assignedToUser">
																@if(isset($formInstance->assignedToUser))
																{{$formInstance->assignedToUser->firstname}} {{$formInstance->assignedToUser->lastname}}
																@endif
															</td>
															<td class="assignedToGroup">
																@if(isset($formInstance->assignedToGroup))
																{{$formInstance->assignedToGroup->group_name}} 
																@endif
															</td>
															<td>
																@if(isset($formInstance->lastFormAction))
																
																{{$formInstance->lastFormAction->log["status_admin_name"]}} by {{$formInstance->lastFormAction->log["user_name"]}}
																@endif
															</td>
														</tr>
			                                    		@endforeach
			                                    	</tbody>
			                                    </table>
			                                </div>
			                            </div>

			                            @endforeach
			                            
			                        </div>


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



	<script type="text/javascript">
		$(".table").dataTable(
        	{
    			
				pageLength: 50,
				responsive: true,
				fixedHeader: true
			}
		);
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});


	</script>
	@include('site.includes.bugreport')


</body>
</html>
