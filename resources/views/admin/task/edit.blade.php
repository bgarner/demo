<!DOCTYPE html>
<html>

<head>
    @section('title', 'Edit Task')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
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

		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edit Task</h5>

                            <div class="ibox-tools">

                                <!-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> -->
                            </div>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="updateTaskForm">

								<input type="hidden" name="banner_id" value={{$banner->id}} >
								<input type="hidden" id="taskId" name="taskId" value={{$task->id}}>

								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
						            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $task->title }}"></div>
								</div>

								<div class="form-group">

						                <label class="col-sm-2 control-label">Publish Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-start" name="publish_date" id="publish_date" value="{{$task->publish_date}}" />


						                    </div>
						                </div>
						        </div>
						        <div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="communication_body" name="description" cols="50" rows="10" id="description">
												{{ $task->description }}

											</textarea>

										</div>
								</div>

						        <div class="form-group">

						                <label class="col-sm-2 control-label">Due Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-end" name="due_date" id="due_date" value="{{$task->due_date}}" />


						                    </div>
						                </div>
						        </div>



								<!-- <div class="existing-files row"> -->
									<div class="form-group">

										<label class="col-sm-2 control-label">Attachments</label>
										<div class="existing-files-container col-md-10">
											@include('admin.task.document-partial', ['task_documents'=>$task_documents])


										</div>


									</div>
								<!-- </div> -->
								<div id="files-staged-to-remove"></div>
								<div id="files-selected" class="row"></div>

								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<div id="add-documents" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add Documents</div>
									</div>
								</div>

								<div class="form-group">

						                <label class="col-sm-2 control-label">Target Stores</label>
						                <div class="col-sm-10">
						                	@if($task->all_stores)
		                                        {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
		                                        {!! Form::label('allStores', 'Or select all stores:') !!}
		                                        {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
		                                    @else
		                                        {!! Form::select('stores', $storeList, $target_stores, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
		                                        {!! Form::label('allStores', 'Or select all stores:') !!}
		                                        {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
		                                    @endif
						                </div>

						        </div>
						        <div class="form-group">

						                <label class="col-sm-2 control-label">Update Task Status
						                </label>
						                <div class="col-sm-3">

		                                        {!! Form::select('status_type_id', $task_status_list, null, [ 'class'=>'chosen', 'id'=> 'status_type_id']) !!}

						                </div>

						        </div>
						        {{--<div class="form-group">

						                <label class="col-sm-2 control-label">Send Reminders</label>
						                <div class="col-sm-10">
						                    {!! Form::checkbox('send_reminder', $task->send_reminder, $task->send_reminder ,['id'=> 'send_reminder'] ) !!}
						                </div>

						        </div>--}}

								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a class="btn btn-white" href="/admin/task"><i class="fa fa-close"></i> Cancel</a>
										<button class="btn btn-primary task-update"><i class="fa fa-check"></i> Update Task</button>
						            </div>
						        </div>

							</form>




                        </div> <!--  ibox content closes-->

                    </div><!-- ibox closes -->
                </div> <!-- col-lg-12 closes -->
            </div><!-- row closes -->


        </div><!-- wrapper closes -->




		<div id="document-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Documents</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
		            	@foreach ($navigation as $nav)

							@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )

								@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])

							@endif

						@endforeach
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id="attach-selected-files">Select Documents</button>
		            </div>
		        </div>
		    </div>
		</div>


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

	    @include('site.includes.bugreport')


		<script type="text/javascript" src="/js/custom/admin/tasks/editTask.js"></script>
		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script>


		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		    $(".chosen").chosen({
				  width:'75%'
			});

		   CKEDITOR.replace('description', {
    		    filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

    		});

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});



		</script>

	</body>
	</html>
