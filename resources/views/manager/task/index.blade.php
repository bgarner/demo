@extends('manager.layouts.master')
@section('title', 'Tasks')
	
@section('style')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
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
        
        .task-status, .project-completion{
        	width: 25%;
        }
        
        #task_title, .input-group-addon{
        	border : none;
        }
        #add_task_input_group{
        	border: thin solid #e9e9e9;
        }
        .project-list{
        	padding:10px 0px;
        }
        #add_task_input_group{
        	height:60px;
        	padding: 10px;
        }
        .modal-body .form-container{
        	padding: 20px;
        }
	</style>

@endsection

@section('content')

	<div class="wrapper wrapper-content  animated fadeInRight">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="mail-box-header">
	                    <h2>All Tasks</h2>
	            </div>
	               
                <div class="mail-box">
					<div class="project-list">
						<form class="form-inline">
							
							<div class="input-group" id="add_task_input_group" style="width:100%;">
								<input type="text" class="form-control" id="task_title" name="task_title" placeholder="Add a task...">
								<input type="text" id="task_publish_date" hidden >
								<input type="text" id="task_due_date" hidden>
								<input type="text" id="task_target" hidden>
								<input type="text" id="task_description" hidden>
								<span class="input-group-addon" 
									   id="date_popover"
									   style="width:2%;">
						            <i class="fa fa-calendar"></i>
						            
						        </span>

								<span class="input-group-addon" 
										style="width:2%;" 
										id="store_select_popover"
										title = "Select Stores">
										<i class="fa fa-users"></i>
								</span>
								<span class="input-group-addon" 
										style="width:2%;" 
										id="description_popover"
										title="Add Description">
										<i class="fa fa-comment"></i>
								</span>
								<span class="input-group-addon task-create" 
										style="width:2%;"
										title="Create Task">
										<i class="fa fa-check"></i>
								</span>
								
								
							</div>
						
						</form>
                        <table class="table table-hover">
                            <tbody>
                            @foreach($tasks as $task)
                            <tr class="project-row" data-task-id="{{$task->id}}">
                                <td class="project-status" rowspan="2">
                                    <span class="label {{$task->status_color}}">{{$task->status}}</span>
                                </td>
                                <td class="project-title" rowspan="2">
                                    <span><strong>{{$task->title}}</strong></span>
                                    <br>
                                    <div>
                                    {!!$task->description!!}
                                    </div>
                                    <span class="label"><small>Due {{$task->prettyDueDate}}</small></span>
                                </td>
                                <td class="project-completion">
                                        {{--<small>Completion with: {{$task->percentage_done}}%</small>--}}
                                        <div>
                                        	<span>Completion :</span>
                                        	<small class="pull-right"> {{ count($task->stores_done) }}/{{count($task->stores)}} Stores</small>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: {{$task->percentage_done}}%;" class="progress-bar progress-bar-primary"></div>
                                        </div>
                                </td>
                                
                                <td class="project-actions" rowspan="2">
                                   	@if($task->creator_id == Auth::user()->id)
                                    	<a href="/manager/task/{{$task->id}}/edit" class="btn btn-primary btn-sm edit-task" data-task-id="{{$task->id}}" title="Edit Task"><i class="fa fa-pencil"></i></a>
                                     	<a class="btn btn-danger btn-sm delete-task" data-task-id="{{$task->id}}" title="Delete Task"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
							</tr>
							<tr>
								<td class="task-status" id="task_status_{{$task->id}}">
                                	<div class="task_status_box" id="task_status_box_{{$task->id}}">
                                	
										
                                    	<!-- <span class="task-not-done"> -->
                                    		@foreach($task->stores_done as $store)
                                    		<span class="store btn btn-xs active-store">{{$store}}</span>
                                    		@endforeach
                                    	<!-- </span>
                                    	<span class="task-done"> -->
                                    		@foreach($task->stores_not_done as $store)
                                    		<span class="store btn btn-xs btn-default">{{$store}}</span>
                                    		
                                    		@endforeach
                                    	<!-- </span> -->
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

	@include('manager.task.editmodal')

	<div hidden>

	    <div id="date_container">
	    	<div class="input-daterange input-group" >
	            <input type="text" class="input-sm form-control datetimepicker-start" name="publish_date" id="publish_date" value="" placeholder="Start date" />
	            <span class="input-group-addon"></span>
	            <input type="text" class="input-sm form-control datetimepicker-end" name="due_date" id="due_date" value="" placeholder="Due date"/>
	        </div>
		</div>
		<div id="store_container">
			<div class="input-group">
				{!! Form::select('stores', $stores, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
				<span  class="btn btn-white input-group-addon pull-right" id="allStores" data-state="0">
					<i class="fa fa-square-o"></i> All Stores
				</span>
			</div>
		</div>

		<div id="description_container">
			<textarea name="description" id="description" cols="30" rows="10"></textarea>
		</div>


	</div>


@endsection

@section('scripts')

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/manager/tasks/crudTask.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<!-- <script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script> -->

@endsection
