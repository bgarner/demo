<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
            #status_update_modal .modal-body{
            	height: 75% !important;
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
						
						<!-- <h2>Product Request</h2> -->

	                    <div class="ibox">
	                        
	                        <div class="ibox-content">
								<div class="tabs-container">
									
									@foreach($assignments as $formCategory => $formInstances)
									<span class="pull-right dropdown edit_multiple_forms" id="actions-tab-{{$loop->iteration}}" style="display: inline;">
                                        <button class="btn btn-primary btn-outline dropdown-toggle" type="button" id="edit_selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i> Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="edit_selected">
                                            
                                            @if($loop->first)
                                            <li id="show_update_status"><a>Update Status</a></li>
											@elseif($loop->last)
                                            <li id="assign_to_user"><a>Assign to User</a></li>
                                            <li id="show_update_status_group_assign"><a>Update Status</a></li>
                                            <li id="remove_user_assigment"><a>Revoke From User</a></li>
                                            <li id="remove_group_assigment"><a>Revoke From Group </a></li>
                                            @endif

                                        </ul>
                                    </span>

                                    @endforeach


			                        <ul class="nav nav-tabs">
										
			                        	@foreach($assignments as $formCategory => $formInstances)
			                            
			                            <li  @if ($loop->first) class="active" @endif><a data-toggle="tab" href="#tab-{{$loop->iteration}}" aria-expanded="false">{{$formCategory}}</a></li>

			                            @endforeach
			                        </ul>
			                        <div class="tab-content" >
			                        	@foreach($assignments as $formCategory => $formInstances)

			                            <div id="tab-{{$loop->iteration}}" class="tab-pane @if ($loop->first) active @endif" id="tab-{{$loop->iteration}}">

			                                <div class="panel-body">
												    														
			                                    <table class="table">
			                                    	<thead>
			                                    		<th>
			                                    			@if(count($formInstances)>0)
			                                    			<input id="select_all" type="checkbox">

			                                    			@endif
			                                    		</th>
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
			                                    			<td><a href='/form/productrequest/{{$formInstance->id}}'> {{$formInstance->description}} </a></td>
															<td>{{$formInstance->store_number}}</td>
															<td data-sort="{{$formInstance->created_at}}">{{$formInstance->prettySubmitted}}</td>
															<td>
																@if(isset($formInstance->assignedToUser))
																{{$formInstance->assignedToUser->firstname}} {{$formInstance->assignedToUser->lastname}}
																@else
																	<button class="btn btn-sm btn-primary assign_to_self" data-userid= "{{ Auth::user()->id}}" data-formInstanceId = "{{$formInstance->id}}" > 
																	<i class="fa fa-user"></i> Assign to Self</button>
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

	<div id="status_update_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Update Status</h4>
                </div>
                <div class="modal-body">
                	<input type="text" hidden value="admin" id="origin">
                    <label>Status</label>
                    <select class="form-control" id="status_code_id">
                        <option value=""></option>
                        @foreach($codes as $code)
                        <option value="{{$code->id}}">{{$code->admin_status}}</option>
                        @endforeach
                    </select>

	                <label>Comments</label>
	                <textarea class="form-control" id="comment"></textarea>
	                <input type="checkbox" id="ask_for_reply" name="ask_for_reply" value="1" /> Allow the store to submit a response to this comment/question.
	                <br />
	                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_form_status">Update</button>
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

    

	@include('admin.includes.footer')

    @include('admin.includes.scripts')



	<script type="text/javascript" src="/js/custom/forms/assignments/assign.js"></script>
	<script type="text/javascript" src="/js/custom/forms/formStatus.js"></script>
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
