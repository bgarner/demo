<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
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
		                            <h5>Store</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/store/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Store</a>
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
    											<td><a href="/admin/store/{{ $store->id }}/edit">{{ $store->name }}</a></td>
                                                <td>
                                                    <a data-store="{{ $store->id }}" id="store{{$store->id}}" class="store-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

				<script src="/js/custom/admin/stores/deleteStore.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
