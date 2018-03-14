<!DOCTYPE html>
<html>

<head>
    @section('title', 'Store Feedback Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >

	<div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                    	<h2>Store Feedback: {{ $formInstance->store_number }} submitted on {{ $formInstance->prettySubmitted }} <small>({{ $formInstance->sinceSubmitted }} ago)</small></h2>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <tr>
                                <td colspan="3">Submitted by: {{ $formInstance->form_data['submitted_by'] }} - {{ $formInstance->form_data['submitted_by_position'] }} at {{ $formInstance->store_number }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>
                                                Request for <strong>{{ strtoupper($formInstance->form_data['requirement']) }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Brand:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['brand'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Description:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['description'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Size:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['size'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Style:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['styleNumber'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Quantity:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['quantity'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Classification:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['department']  }} <i class="fa fa-caret-right"></i> {{ $formInstance->form_data['category'] }} <i class="fa fa-caret-right"></i> {{ $formInstance->form_data['subcategory'] }}</div>
                                    </div>






                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <p><strong>Comments:</strong></p>
                                    <p>
                                    {{ $formInstance->form_data['comments'] }}
                                    </p>
                                </td>
                            </tr>

                        </table>




                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                    @include('admin.form.partials.log')
                </div>

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
		<script src="/js/custom/site/form/storefeedbackform.js"></script>



		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>

	</body>
	</html>
