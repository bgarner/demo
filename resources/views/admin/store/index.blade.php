<!DOCTYPE html>
<html>

<head>
    @section('title', 'Stores')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
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
                            <h5>Store</h5>
                            <div class="ibox-tools">
                                <a id="add-store" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Store</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

								<table class="table datatable">
                                    <thead>
										<tr>
											
											<td>Store Number</td>
                                            <td>Store Name</td>
                                            <td></td>

										</tr>
                                    </thead>

                                    <tbody>
									@foreach($stores as $store)
									<tr>


										<td>{{ $store->store_number }}</td>
										<td><a class="edit-store" href="/admin/store/{{ $store->id }}/edit">{{ $store->name }}</a></td>
                                        <td>
                                            <a data-store-id="{{ $store->id }}" id="store{{$store->id}}" class="delete-store btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
    </div>

	</div>

	<div id="add-store-modal" class="modal inmodal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	{!! Form::open(['action' => 'StoreApi\StoreAdminController@store']) !!}
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Create New Store</h4>
	            </div>
	            <div class="modal-body">

	            	<div class="form-group">
                    	<label class="control-label">Store Name <span class="req">*</span></label>
                        <div ><input type="text" class="form-control" name="store_name" id="store_name" value=""></div>
                    </div>

                    <div class="form-group">
                    	<label class="control-label">Store Number <span class="req">*</span></label>
                        <div >
                        	<input type="text" pattern="\d+" maxlength="4" minlength="3" class="form-control" name="store_number" id="store_number" value="">
                        </div>
                    </div>
                    

                    <div class="form-group">
                    	<label class="control-label">Address </label>
                        <div ><input type="text" class="form-control" name="address" id="address" value=""></div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label">City <span class="req">*</span></label>
                        <div ><input type="text" class="form-control" name="city" id="city" value=""></div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label">Province <span class="req">*</span></label>
                        {!! Form::select('province', $provinces, null, [ 'class'=>'chosen', 'id'=> 'province']) !!}
                    </div>
                    <div class="form-group">
                    	<label class="control-label">Postal Code </label>
                        <div ><input type="text" class="form-control" name="postal_code" id="postal_code" value=""></div>
                    </div>

                    <div class="form-group">
                        
                        <div ><input type="checkbox" id="is_combo_store" name="is_combo_store" class="" /> Is this a combo store.</div>
                    </div>                          

                    <div class="form-group">
                        <label class="control-label">Banner <span class="req">*</span></label>
                        {!! Form::select('banner_id', $banners, null, [ 'class'=>'chosen', 'id'=> 'banner_id']) !!}
                    </div>
                    <div class="form-group">
                    	<label class="control-label">District <span class="req">*</span></label>
                        {!! Form::select('district_id', $districts, null, [ 'class'=>'chosen', 'id'=> 'district_id']) !!}
                    </div>

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary" id="create-alerttype">Add Store</button>
	            </div>
	            {!! Form::close() !!}
	        </div>
	    </div>
	</div>

    <div id="edit-store-modal" class="modal inmodal fade">
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
                
            // });

		</script>

		<script src="/js/custom/admin/stores/crudStore.js"></script>
		<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

		@include('site.includes.bugreport')



	</body>
	</html>
