<!DOCTYPE html>
<html>

<head>
    @section('title', 'Edit Task List')
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
                            <h5>Edit Task List</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="updateTaskForm">

								<input type="hidden" id="tasklistId" name="tasklistId" value={{$tasklist->id}}>
								<input type="hidden" name="optGroupSelections" id="optGroupSelections" value="{{$optGroupSelections}}">
								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
						            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $tasklist->title }}"></div>
								</div>

								<div class="form-group">

						                <label class="col-sm-2 control-label">Publish Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-start" name="publish_date" id="publish_date" value="{{$tasklist->publish_date}}" />


						                    </div>
						                </div>
						        </div>
						        <div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="communication_body" name="description" cols="50" rows="10" id="description">
												{{ $tasklist->description }}

											</textarea>

										</div>
								</div>

						        <div class="form-group">

						                <label class="col-sm-2 control-label">Due Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-end" name="due_date" id="due_date" value="{{$tasklist->due_date}}" />


						                    </div>
						                </div>
						        </div>

								@include('admin.includes.the-ultimate-store-selector')
						        

								<div class="hr-line-dashed"></div>
								

							</form>




                        </div> <!--  ibox content closes-->

                    </div><!-- ibox closes -->

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tasks</h5>

                            <div class="ibox-tools">

                        	</div>


                        </div>

                        <div class="ibox-content">

			                <div class="input-group">
									<input type="text" class="form-control" name="new_task" id="new_task" value="" placeholder="Add Task..."/>
									<span class="input-group-btn" >
										<a class="btn btn-primary btn-outline" id="add-task" onclick="stageTask()" >
										<i class="fa fa-plus"></i> Add Task</a>
									</span>
							    </div>

							<div >
                        		@include('admin.tasklist.task-partial', ['tasklist_tasks'=>$tasklist->tasks])
							</div>
							<div id="tasks-staged-to-remove"></div>
							

                        </div>

                    </div><!-- ibox closes-->
                    <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<a class="btn btn-white" href="/admin/tasklist"><i class="fa fa-close"></i> Cancel</a>
							<button class="btn btn-primary tasklist-update"><i class="fa fa-check"></i> Update Task</button>
			            </div>
			        </div>
                </div> <!-- col-lg-12 closes -->
            </div><!-- row closes -->


        </div><!-- wrapper closes -->

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

	    @include('site.includes.bugreport')


		<script type="text/javascript" src="/js/custom/admin/tasklist/editTasklist.js"></script>
		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>


		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		    $(".chosen").chosen({
				  width:'75%'
			});

    		CKEDITOR.replace('description');

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});



		</script>

	</body>
	</html>
