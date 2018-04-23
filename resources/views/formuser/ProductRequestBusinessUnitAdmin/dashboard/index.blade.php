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
            #user_assignment_modal .modal-body, #group_assignment_modal .modal-body{
            	height: 70% !important;
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
	                        <div class="ibox-title">
	                        	<h2>Request Status</h2>
	                        	<div class="ibox-tools">
	                        		<span class="dropdown" id="edit_multiple_forms" style="display: inline;">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="edit_selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Edit Selected
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="edit_selected">
                                            <li id="assign_to_group"><a>Assign to Group</a></li>
                                            <li id="assign_to_user"><a>Assign to User</a></li>
                                        </ul>
                                    </span>
									
	                            </div>
	                        </div>
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
			                                    		<th>@if(count($formInstances)>0)<input id="select_all" type="checkbox">@endif</th>
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
			                                    			<td><input class="select_form" id="select_form" type="checkbox" data-formInstanceId = "{{$formInstance->id}}"></td>
			                                    			<td><a href="/form/productrequest/{{$formInstance->id}}"> {{$formInstance->description}}</a></td>
															<td>{{$formInstance->store_number}}</td>
															<td>{{$formInstance->prettySubmitted}}</td>
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

	                    <div id="user_assignment_modal" class="modal fade">
		                    <div class="modal-dialog">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                <h4 class="modal-title">Select User</h4>
		                            </div>
		                            <div class="modal-body">
		                                @include('formuser.assignments.user-list-partial', ['users' =>$users])
		                            </div>
		                            <div class="modal-footer">
		                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                                <button type="button" class="btn btn-primary" id="update_user_assignment">Update</button>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div id="group_assignment_modal" class="modal fade">
		                    <div class="modal-dialog">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                <h4 class="modal-title">Select Group</h4>
		                            </div>
		                            <div class="modal-body">
		                                @include('formuser.assignments.group-list-partial', ['groups' =>$groups])
		                            </div>
		                            <div class="modal-footer">
		                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                                <button type="button" class="btn btn-primary" id="update_group_assignment">Update</button>
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



	<script type="text/javascript" src="/js/custom/forms/assignments/assign.js"></script>
	<script type="text/javascript">

		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});


	</script>
	@include('site.includes.bugreport')


</body>
</html>
