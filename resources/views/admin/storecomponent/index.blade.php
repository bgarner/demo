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

								<table class="table datatable componentTable">
									<thead>
										<tr>
											<td>Id</td>
											<td>Component Name</td>
											<td>Component Label</td>
											<td>Action</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
									@foreach($store_components as $store_component)
									<tr @if(isset($store_component->subcomponents)) class="details-control" @endif>
										<td >{{ $store_component->id }}</td>
										<td>{{ $store_component->component_name }}</td>
										<td>{{ $store_component->component_label }}</td>

										<td>
											
											<a  href="#"
												@if($store_component->state == 'on')
												class="btn btn-primary btn-xs component-edit"
												@else
												class="btn btn-default btn-xs component-edit"
												@endif
												title="Toggle Visibility"

												data-state='{{$store_component->state}}'
												id="store_component_{{$store_component->id}}"
												data-component-id="{{$store_component->id}}">

												@if($store_component->state == 'on')
												<i class="fa fa-eye"></i>
												@else
												<i class="fa fa-eye-slash"></i>
												@endif

											</a>
											@if(isset($store_component->subcomponents))
											<a class="btn btn-primary btn-xs ">
												<span><i class="fa fa-caret-down"></i> </span>
											</a>
											@endif

										</td>
										<td>
											{{$store_component->subcomponents}}
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

	</script>


	@include('site.includes.bugreport')

	<script type="text/javascript" src="/js/custom/admin/storecomponents/editComponent.js"></script>

</body>
</html>
