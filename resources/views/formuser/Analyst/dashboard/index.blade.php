<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
            .modal-dialog{
                height: 380px;
            }
            .bignumber{
                font-size: 72px;
                text-align: center;
                letter-spacing: -3px;
                font-weight: bold;
                margin: 0; padding: 0;
                min-height: 72px;
            }
            .bignumber-ttc{
                font-size: 60px;
                font-weight: bold;
                min-height: 80px;
            }
            .stat-percent{
                font-size: 36px;
            }
            .perc-box{
                width: 100%; 
                padding: 5px 10px 15px 10px;
                min-height: 60px;
            }
        </style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('formuser.includes.sidenav')
	        </div>
	    </nav>

		<div id="page-wrapper" class="gray-bg" >

			<div class="wrapper wrapper-content  animated fadeInRight">
	            <div class="row">
	                <div class="col-lg-12">
						
						<h2>Product Request</h2>

	                    <div class="ibox">
	                        
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
			                                    		<th>Description</th>
			                                    		<th>Store#</th>
			                                    		<th>Submitted At</th>
			                                    		<th>User Assigned To</th>
			                                    		<th>Last Action</th>
			                                    	</thead>
			                                    	<tbody>
			                                    		@foreach($formInstances as $formInstance)
			                                    		<tr>
			                                    			<td><a href='/form/productrequest/{{$formInstance->id}}'> {{$formInstance->description}} </a></td>
															<td>{{$formInstance->store_number}}</td>
															<td>{{$formInstance->prettySubmitted}}</td>
															<td>
																@if(isset($formInstance->assignedTo))
																{{$formInstance->assignedTo->firstname}} {{$formInstance->assignedTo->lastname}}
																@endif
															</td>
															<td>
																@if(isset($formInstance->lastFormAction))
																
																{{$formInstance->lastFormAction->log["status_admin_name"]}} by {{$formInstance->lastFormAction->log["user_name"]}}
																@endif
															</td>
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
