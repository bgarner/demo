<!DOCTYPE html>
<html>

<head>
    @section('title', 'Regions')
    @include('admin.includes.head')
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
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
                            <h5>Region</h5>
                            <div class="ibox-tools">
                                <a id="add-region" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Region</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
								<table class="table datatable">
                                    <thead>
										<tr>
											<td>Region</td>
                                            <td>Manager</td>
                                            <td></td>
										</tr>
                                    </thead>

                                    <tbody>
									@foreach($regions as $region)
									<tr>
										<td><a class="edit-region" href="/admin/region/{{ $region->id }}/edit">{{ $region->name }}</a></td>
										@if(isset($region->avp_details->firstname))
										<td>{{ $region->avp_details->firstname }} {{ $region->avp_details->lastname }}</td>

										@else
										<td></td>
										@endif
                                        <td>
                                            <a data-region-id="{{ $region->id }}" id="region{{$region->id}}" class="delete-region btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

    	<div id="add-region-modal" class="modal inmodal fade">
    	    <div class="modal-dialog">
    	        <div class="modal-content">
    	        	{!! Form::open(['action' => 'StoreApi\RegionAdminController@store']) !!}
    	            <div class="modal-header">
    	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    	                <h4 class="modal-title">Create New Region</h4>
    	            </div>
    	            <div class="modal-body">

    	            	<div class="form-group">
                        	<label class="control-label">Region Name <span class="req">*</span></label>
                            <div ><input type="text" class="form-control" name="region_name" id="region_name" value=""></div>
                        </div>
                        {{-- <div class="form-group">
                        	<label for="districts">Districts <span class="req">*</span></label>
                        	{!! Form::select('districts', $districts, null, [ 'class'=>'chosen', 'id'=> 'districts', 'multiple'=>'true']) !!}
                        </div> --}}

    	            </div>
    	            <div class="modal-footer">
    	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	                <button type="submit" class="btn btn-primary" id="create-region">Add Region</button>
    	            </div>
    	            {!! Form::close() !!}
    	        </div>
    	    </div>
    	</div>
    	<div id="edit-region-modal" class="modal inmodal fade">
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
            $(".datatable").DataTable({
                
            });
            

		</script>

		<script src="/js/custom/admin/regions/crudRegions.js"></script>
		<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

		@include('site.includes.bugreport')



	</body>
	</html>
