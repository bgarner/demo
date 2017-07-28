<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
			
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Tasks</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Tasks</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
	        <div class="row">
	            <div class="col-lg-12">
	            	
	            	<div class="ibox">
	            		<div class="ibox-title">
	            			<h5>Add New Task</h5>
	            		</div>
	            		<div class="ibox-content">
	            			<form class="form-inline">
									
										<div class="input-group" style="width:100%;">
											<input type="text" class="form-control" id="title" name="title">
											<span class="input-group-addon" 
												   id="due_date_popover"
												   style="width:5%"
												   title ="Select a Due Date">
									            <i class="fa fa-calendar"></i>
									            
									        </span>
											<span class="input-group-addon" 
													style="width:5%;" 
													id="store_select_popover"
													title = "Select Stores">
													<i class="fa fa-users"></i>
											</span>
											<span class="input-group-addon" 
													style="width:5%;" 
													id="description_popover"
													title="Add Description">
													<i class="fa fa-comment"></i>
											</span>
											<span class="input-group-addon task-create" 
													style="width:5%;"
													title="Create Task">
													<i class="fa fa-check"></i>
											</span>
											
											
										</div>
									
								</form>
								<div class="ibox-content" id="due_date_ibox">
									
										<div class="row">
											<div class="input-group">
											<input class="form-control" id="due_date" name="due_date" placeholder="Due Date"/>
											<span class="btn btn-danger input-group-addon" id="clear_due_date">Clear</span>
											<span  class="btn btn-white input-group-addon" id="send_reminder" data-state="0">
												<i class="fa fa-square-o"></i>
												Send Reminder
											</span>
											</div>
										</div>
										<div id="due_date_selector"></div>

								</div>
								<div class="ibox-content" id="store_selector_ibox">
									
										<div class="row">
										
							                <div class="input-group">
							                    {!! Form::select('stores', $stores, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
							                
							                
							                    
						                    <span  class="btn btn-white input-group-addon" id="allStores" data-state="0">
												<i class="fa fa-square-o"></i>
												All Stores
											</span>
						                
						                    <span class="btn btn-white input-group-addon" id="confirm-store-select" > Done </span>
							                </div>
							                
						                </div>

								</div>

								<div class="ibox-content" id="description_ibox">
									
										<div class="row">
										
							                <div class="input-group">
							                   <textarea name="description" id="description" cols="30" rows="10"></textarea>
							                </div>
							                
						                </div>

								</div>
								<hr>
	            		</div><!-- ibox content -->

	            	</div> <!-- ibox ends -->


	                <div class="ibox">
	                    <div class="ibox-title">
	                        <h5>All Tasks</h5>

	                        <div class="ibox-tools">

	                        </div>
	                    </div>
	                   
	                    <div class="ibox-content">
							<div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($tasks as $task)
                                    <tr class="project-row" data-task-id="{{$task->id}}">
                                        <td class="project-status" rowspan="2">
                                            <span class="label {{$task->status_color}}">{{$task->status}}</span>
                                        </td>
                                        <td class="project-title" rowspan="2">
                                            {{$task->title}}
                                            <br>
                                            <small>Created {{$task->created_at}}</small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Completion with: {{$task->percentage_done}}%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: {{$task->percentage_done}}%;" class="progress-bar progress-bar-primary"></div>
                                                </div>
                                        </td>
                                        <td class="project-people" rowspan="2">
                                        	
                                            <span> {{count($task->stores)}} Stores </span>
                                            
                                            
                                        </td>
                                        <td class="project-actions" rowspan="2">
                                           
                                            <a href="/manager/task/{{$task->id}}/edit" class="btn btn-white btn-sm edit-task" data-task-id="{{$task->id}}" ><i class="fa fa-pencil"></i> Edit </a>
                                             <a class="btn btn-white btn-sm delete-task" data-task-id="{{$task->id}}"><i class="fa fa-trash"></i> Delete </a>
                                        </td>
									</tr>
									<tr>
										<td class="task-status" id="task_status_{{$task->id}}">
	                                    	<div class="task_status_box" id="task_status_box_{{$task->id}}">
	                                    	

	                                        	<span class="task-not-done">
	                                        		@foreach($task->stores_done as $store)
	                                        		<span><i class="fa fa-check"></i> {{$store}}</span>	
	                                        		<br>
	                                        		@endforeach
	                                        	</span>
	                                        	<span class="task-done">
	                                        		@foreach($task->stores_not_done as $store)
	                                        		<span><i class="fa fa-times"></i> {{$store}}</span>
	                                        		<br>
	                                        		@endforeach
	                                        	</span>

	                                        
	                                    	</div>
	                                	</td>
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
        @include('manager.task.editmodal')

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/manager/tasks/addTask.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<!-- <script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script> -->


		@include('site.includes.bugreport')

	</body>
</html>
