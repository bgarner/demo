<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
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
	                            <h5>Dashboard</h5>

	                            
	                        </div>
	                        <div class="ibox-content">
								<div class="tabs-container">
			                        <ul class="nav nav-tabs">
										
			                        	@foreach($forms as $formCategory => $formInstances)
			                            
			                            <li  @if ($loop->first) class="active" @endif><a data-toggle="tab" href="#tab-{{$loop->iteration}}" aria-expanded="false">{{$formCategory}}</a></li>

			                            @endforeach
			                        </ul>
			                        <div class="tab-content">
			                        	@foreach($forms as $formCategory => $formInstances)

			                            <div id="tab-{{$loop->iteration}}" class="tab-pane @if ($loop->first) active @endif">
			                                <div class="panel-body">
			                                    <table class="table">
			                                    	<thead>
			                                    		
			                                    		<th>Store#</th>
			                                    		<th>Submitted At</th>
			                                    		<th>User Assigned To</th>
			                                    		<th>Last Action</th>
			                                    	</thead>
			                                    	<tbody>
			                                    		@foreach($formInstances as $formInstance)
			                                    		<tr>
															<td>{{$formInstance->store_number}}</td>
															<td>{{$formInstance->created_at}}</td>
															<td>User Assigned to </td>
															<td>Last Action</td>
														</tr>
			                                    		@endforeach
			                                    	</tbody>
			                                    </table>
			                                </div>
			                            </div>

			                            @endforeach
			                            
			                        </div>


			                    </div>
	                        </div>

	                    </div>
	                </div>
	            </div>


	        </div>
	    </div>
	</div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')



	<script type="text/javascript" src="/js/custom/forms/groups/deleteGroup.js"></script>
	<script type="text/javascript">

		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});


	</script>
	@include('site.includes.bugreport')


</body>
</html>
