<!DOCTYPE html>
<html>

<head>
    @section('title', 'Store Components')
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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Store Components</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Store Components</strong>
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
	                        <h5>All Store Components</h5>

	                        <div class="ibox-tools">

	                            
	                        </div>
	                    </div>
	                    <div class="ibox-content">

	                        <div class="table-responsive">

								<table class="table datatable">
									<thead>
										<tr>
											<td>Id</td>	
											<td>Component Name</td>
											<td>Component Label</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
									@foreach($store_components as $store_component)
									<tr>
										<td>{{ $store_component->id }}</td>
										<td>{{ $store_component->component_name }}</td>
										<td>{{ $store_component->component_label }}</td>
										
										<td>
											<a href="/admin/storecomponent/{{ $store_component->id }}/edit" class="btn btn-danger btn-sm" title="Toggle Visibility"><i class="fa fa-eye-slash"></i></a>

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

	@include('admin.includes.footer')

    @include('admin.includes.scripts')

	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

        $(".datatable").dataTable( 
        	{
			
				"columns": [	
				    { "visible": false },
				    { "width": "45%" },
				    null,
				    { "width" : "10%" , "sortable" : false}
				  ],
				"bPaginate": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false
			}
		);

	</script>
	

	@include('site.includes.bugreport')

	<script type="text/javascript" src="/js/custom/admin/storecomponent/editComponent.js"></script>

</body>
</html>
