<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Request Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

	<div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Product Request</h5>
                        <div class="ibox-tools">
                            <a href="{{\Request::url()}}/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <th>Date Submitted</th>
                                <th>Submitted By</th>
                                <th>Request</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($forms as $form)

                                    <tr>
                                        <td><a href="{{\Request::url()}}/{{$form->id}}">{{$form->created_at}}</a></td>
                                        <td>{{$form->submitted_by}}</td>
                                        <td>we will fill this in a min</td>
                                        <td>stattus goes here</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>


                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->




            </div>
        </div>


    </div><!-- wrapper closes -->


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script src="/js/custom/forms/ProductRequestForm.js"></script>



		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>

	</body>
	</html>
