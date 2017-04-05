<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	{{-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> --}}
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
            <div class="col-lg-12">
                <h2>Flyer</h2>
                <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Flyer</strong>
                        </li>
                    </ol>
                
                <div class="col-lg-2">

                </div>
            </div>
        </div>        


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                    
                        <div class="ibox-title">

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
										<tr class="flyer" role="row" data-flyer-id="{{$flyer->id}}">
											<td>{{ $flyer->flyer_name }}</td>
											<td>{{ $flyer->start_date }}</td>
											<td>{{ $flyer->end_date }}</td>
											<td>
												<a href="/admin/flyer/{{ $flyer->id }}/" class="btn btn-primary btn-sm" title="View Flyer"><i class="fa fa-eye"></i></a>
												<a data-flyer="{{ $flyer->id }}" id="flyer{{ $flyer->id }}" title="Delete Flyer" class="delete-flyer btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

		@include('site.includes.footer')

	    @include('admin.includes.scripts')

	
		<script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>
		<script type="text/javascript" src="/js/custom/admin/flyers/editFlyer.js"></script>
		<script type="text/javascript" src="/js/custom/admin/flyers/deleteFlyer.js"></script>

		<script>
			
	        $(document).ready(function(){
	        	console.log("ready");
	            $('.dataTable').DataTable({
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
