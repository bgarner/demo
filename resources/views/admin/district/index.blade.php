<!DOCTYPE html>
<html>

<head>
    @section('title', 'Stores')
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
                            <h5>Districts</h5>
                            <div class="ibox-tools">
                                <a id="add-district" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New District</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
								<table class="table datatable">
                                    <thead>
										<tr>
											
											<td>District</td>
                                            <td>Manager</td>
                                            <td></td>

										</tr>
                                    </thead>

                                    <tbody>
									@foreach($districts as $district)
									<tr id="district{{$district->id}}">
										
										<td><a class="edit-district" data-district-id="{{$district->id}}" href="/admin/district/{{ $district->id }}/edit">{{ $district->name }}</a></td>
										@if(isset($district->dm_details->firstname))
										<td>{{ $district->dm_details->firstname }} {{ $district->dm_details->lastname }}</td>
										@else
										<td></td>
										@endif
                                        <td>
                                        	{{-- @if(!isset($district->dm_details->firstname)) --}}
                                            <a data-district-id="{{ $district->id }}" id="district{{$district->id}}" class="delete-district btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            {{-- @endif --}}
                                        </td>
										
                                       
									</tr>
									@endforeach
                                    <tbody>
								</table>


                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

    	<div id="add-district-modal" class="modal inmodal fade">
    	    <div class="modal-dialog">
    	        <div class="modal-content">
    	        	{!! Form::open(['action' => 'StoreApi\DistrictAdminController@store']) !!}
    	            <div class="modal-header">
    	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    	                <h4 class="modal-title">Create New District</h4>
    	            </div>
    	            <div class="modal-body">

    	            	<div class="form-group">
                        	<label class="control-label">District Name <span class="req">*</span></label>
                            <div ><input type="text" class="form-control" name="district_name" id="district_name" value=""></div>
                        </div>

                        <div class="form-group">
                        	<label for="region">Region <span class="req">*</span></label>
                        	{!! Form::select('region', $regions , "", ['class'=>'form-control', 'id'=>'region']) !!}
                        </div>

    	            </div>
    	            <div class="modal-footer">
    	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	                <button type="submit" class="btn btn-primary" id="create-district">Add District</button>
    	            </div>
    	            {!! Form::close() !!}
    	        </div>
    	    </div>
    	</div>
    	<div id="edit-district-modal" class="modal inmodal fade">
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

			// $(".datatable").DataTable({
			// 	// "paging" : false
			// });

		</script>

		<script src="/js/custom/admin/districts/crudDistricts.js"></script>
		<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>

		@include('site.includes.bugreport')



	</body>
	</html>
