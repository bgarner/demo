<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Communication Types')
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

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>New Communication Type</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/communication/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> New Commuincation</a> --}}

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" name="communication_type" id="communication_type" value=""></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Label Colour</label>
                                            <div class="col-sm-10">
                                            	            <div class="btn-group" data-toggle="buttons">
											                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="inverse" /> <i class="fa fa-circle text-inverse"></i>
											                </label>
											                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="danger" /> <i class="fa fa-circle text-danger"></i>
											                </label>
											                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="primary" /> <i class="fa fa-circle text-primary"></i>
											                </label>
											                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="info" /> <i class="fa fa-circle text-info"></i>
											                </label>
											                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="warning" /> <i class="fa fa-circle text-warning"></i>
											                </label>
	<!-- 										                <label class="btn btn-outline btn-default">
											                    <input type="radio" id="" name="colour" value="text-primary" /> <i class="fa fa-circle text-primary"></i>
											                </label> -->
											            </div>





                                            	{{-- <input type="text" class="form-control" name="communication_type" id="communication_type" value=""> --}}
                                            </div>
                                        </div>


                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/communicationtypes"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="communicationtype-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Communication Type</button>

                                            </div>
                                        </div>
                                    </form>


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
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
				</script>

				<script src="/js/custom/admin/communications/addCommunicationType.js"></script>


				@include('site.includes.bugreport')

			</body>
			</html>
