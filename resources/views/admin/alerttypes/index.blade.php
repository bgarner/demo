<!DOCTYPE html>
<html>

<head>
    @section('title', 'Alert Types')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <style>
        .modal-dialog{
            height: 280px;
        }
        .modal-body{
            padding:50px 30px 30px 30px;
        }
    </style>
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
                    <h2>Alert Types</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Alert</a>
                        </li>
                        <li class="active">
                            <strong>Manage Alert Types</strong>
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
                            <h5>Alert Types</h5>

                            <div class="ibox-tools">

                                <a id="add-alerttype" class="btn btn-primary btn">
                                	<i class="fa fa-plus"></i> Add New Alert Type
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">



                            <div class="table-responsive">

								<table class="table table-hover issue-tracker" id="alerttype_list">

								<tr>								
									<td>Alert Type</td>
									<td></td>
								</tr>
								@foreach($alerttypes as $at)
								<tr id="alertType{{$at->id}}">	
									<td><a class="edit-alerttype" data-alertype-id="{{ $at->id }}" href="/admin/alerttypes/{{$at->id}}/edit">
                                            {{ $at->name }}
                                        </a>
                                    </td>
									<td>
										{{-- <a class="edit-alerttype" data-alertype-id="{{ $at->id }}" href="/admin/alerttypes/{{$at->id}}/edit">
											<button class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>
											</button>
										</a> --}}
										
										<a class="delete-alerttype" data-alertCount="{{$at->alertCount}}" data-alertType-id="{{ $at->id }}"
											data-alertType="{{$at->name}}"
										>
											<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
											</button>
										</a>
										
										
									</td>
								</tr>
								@endforeach

								</table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div id="add-alerttype-modal" class="modal inmodal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                	{!! Form::open(['action' => 'Alert\AlertTypesAdminController@store']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create New Alert Type</h4>
                    </div>
                    <div class="modal-body">
                    	
                    	<div class="form-group">
                        	<label class="control-label">Alert Type Name <span class="req">*</span></label>
                            <div ><input type="text" class="form-control" name="alert_type" id="alert_type" value=""></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="create-alerttype">Add Alert Type</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div id="edit-alerttype-modal" class="modal inmodal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                   
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

		<script src="/js/custom/admin/alerts/alertType.js"></script>
		<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>



		@include('site.includes.bugreport')



	</body>
	</html>
