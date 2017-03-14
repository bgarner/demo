<!DOCTYPE html>
<html>

<head>
    @section('title', 'Store Feedback')
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
                    <h2>Store Feedback</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Store Feedback</strong>
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
                            <h5>All Feedback</h5>

                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive">

								<table class="table table-hover issue-tracker">

								<tr>
									<td>Type</td>
									<td>Subject</td>
									
									<td>Store Number</td>
									<td>Action</td>
								</tr>

								@foreach($feedbacks as $feedback)
								
								@if(isset( $feedback->feedback_code->icon ))
								<tr class="feedback-list-item" >		
										<td title="{!! $feedback->feedback_code->name !!}">
											{!! $feedback->feedback_code->icon !!}
										</td>
										<td>
											<div>{!! $feedback->description !!}</div>
											
											@if($feedback->follow_up)
											<div class="feedback-follow-up">
												
												@if(isset($feedback->response->followed_up) && $feedback->response->followed_up)
													<input type="checkbox" name="followed_up" value="1" checked="true" disabled> {{"Followed up"}}
												@else
													<input type="checkbox" name="followed_up" value="0" disabled> {{"Followed up"}}
												@endif
											</div>
											@endif


											@if(isset($feedback->response->closed) && $feedback->response->closed  )
												<div class="feedback-status">
													<input type="checkbox" name="closed" value="1" checked="true" disabled> {{"Closed"}}
												</div>	
											@endif
											
										</td>	
									@else
									<tr class="feedback-list-item unread">
										<td></td>
										<td >
											<div>
											{!! $feedback->description !!}
											</div>
										</td>	
									@endif
									
									
									<td>{!! $feedback->store_number !!}</td>
									
									<td>
										<a href="/admin/feedback/{{ $feedback->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										<a data-feedback="{{ $feedback->id }}" id="feedback{{ $feedback->id }}" class="delete-feedback btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

									</td>

									
								</tr>
								@endforeach

								</table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

		@include('site.includes.footer')

	    @include('admin.includes.scripts')

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>

		<script type="text/javascript" src="/js/custom/admin/storefeedback/deleteFeedback.js"></script>
		

		@include('site.includes.bugreport')



	</body>
	</html>
