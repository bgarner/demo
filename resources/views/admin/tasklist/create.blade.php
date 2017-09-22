<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Tasklist')
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
                            <h5>Create a New Task List</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="createNewTaskForm">

								<div class="form-group">
									<label class="col-sm-2 control-label">Title <span class="req">*</span> </label>
						            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="description" name="body" cols="50" rows="10" id="body"></textarea>
										</div>
								</div>
								<div class="form-group">
						                <label class="col-sm-2 control-label">Publish Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-start" name="publish_date" id="publish_date" value="" />
						                    </div>
						                </div>
						        </div>
								<div class="form-group">
						                <label class="col-sm-2 control-label">Due Date</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-end" name="due_date" id="due_date" value="" />
						                    </div>
						                </div>
						        </div>


								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<div id="add-documents" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add Task</div>
									</div>
								</div>
								<div class="form-group">
									<div id="files-selected"></div>
								</div>

						        <div class="form-group">

					                <label class="col-sm-2 control-label">Target Stores</label>
					                <div class="col-sm-10">
					                	<select name="stores" id="storeSelect" multiple class="chosen">
							            	<option value="">Select Some Options</option>
							            	@foreach($storeAndStoreGroups as $option)

							                    <option value="{{$option['id']}}"

							                        @if(isset($option["isStoreGroup"]))
														data-isStoreGroup = "{{$option['isStoreGroup']}}"
							                        @endif
							                        @if(isset($option["stores"]))
														data-stores = "{{$option['stores']}}"
							                        @endif

							                    >
							                        {{$option['name']}}
							                    </option>

							            	@endforeach

							        	</select>
							        	{!! Form::label('allStores', 'Or select all stores:') !!}
							        	{!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
					                </div>

					        	</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a class="btn btn-white" href="/admin/task"><i class="fa fa-close"></i> Cancel</a>
										<button class="btn btn-primary task-create"><i class="fa fa-check"></i> Create New Task List</button>
						            </div>
						        </div>

							</form>




                        </div> <!-- ibox-content closes -->

                    </div><!-- ibox closes -->
                </div>
            </div>


        </div><!-- wrapper closes -->

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/admin/tasks/addTask.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
		<!-- <script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script> -->
		<script type="text/javascript" src="/js/custom/admin/global/storeAndStoreGroupSelector.js"></script>

		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

			$(".date").datetimepicker({
		          format: 'YYYY-MM-DD HH:mm:ss'
		    });

		    $(".chosen").chosen({
				  width:'75%'
			});

		   	CKEDITOR.replace('body', {

    		    filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

    		});

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

		    $("#add-documents").click(function(){
		    	$("#document-listing").modal('show');
		    });

		</script>

	</body>
	</html>
