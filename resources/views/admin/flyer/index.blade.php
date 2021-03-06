<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	{{-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> --}}
	<style>
        .modal-dialog{
            height: 380px;
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


		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-title">
                            <h5>Flyers</h5>
                            <div class="ibox-tools">

                                <a href="/admin/flyer/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Flyer</a>
                            </div>
                        </div>

                        <div class="ibox-content">

	                    	<table class="table dataTable" id="flyerDataTable">
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Flyer Name</th>
	                    				<th>Start Date</th>
	                    				<th>End Date</th>
	                    				<th></th>
	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($flyers as $flyer)
										<tr role="row" data-flyer-id="{{$flyer->id}}" 
											@if($flyer->archived)
												class="flyer archived"
											@else
												class="flyer"
											@endif
											>
											<td><a href="/admin/flyer/{{ $flyer->id }}" title="View Flyer">{{ $flyer->flyer_name }}</a></td>
											<td >{{ $flyer->start_date }}</td>
											<td >{{ $flyer->end_date }}</td>
											<td>
												<a href="#" class="editFlyer btn btn-primary btn-sm btn-outline" id="flyer{{ $flyer->id }}" data-flyer-id="{{ $flyer->id }}" title="Edit Flyer"><i class="fa fa-pencil"></i></a>

												<a data-flyer-id="{{ $flyer->id }}" id="flyer{{ $flyer->id }}" title="Delete Flyer" class="delete-flyer btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')


		<script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>
		<script type="text/javascript" src="/js/custom/admin/flyers/editFlyer.js"></script>
		<script type="text/javascript" src="/js/custom/admin/flyers/deleteFlyer.js"></script>


		<script>
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});
	        $(document).ready(function(){

            	$(".dataTable").dataTable({
		    			"order": [[ 1, 'desc' ]],
					
						"columns": [	
						    
						    { "width": "45%" },
						    null,
						    null,
						    null
						  ],
						pageLength: 50,
						responsive: true,
						fixedHeader: true
					
				});


			});


		</script>


		@include('site.includes.modal')
        @include('admin.folder.foldermodal')

	</body>
	</html>
