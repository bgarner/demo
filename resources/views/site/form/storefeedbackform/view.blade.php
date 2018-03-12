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
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>

                                            <div class="vertical-timeline-content">
                                                <h2>Meeting</h2>
                                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                                </p>
                                                <a href="#" class="btn btn-sm btn-primary"> More info</a>
                                                    <span class="vertical-date">
                                                        Today <br>
                                                        <small>Dec 24</small>
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon blue-bg">
                                                <i class="fa fa-file-text"></i>
                                            </div>

                                            <div class="vertical-timeline-content">
                                                <h2>Send documents to Mike</h2>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                                <a href="#" class="btn btn-sm btn-success"> Download document </a>
                                                    <span class="vertical-date">
                                                        Today <br>
                                                        <small>Dec 24</small>
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon lazur-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>

                                            <div class="vertical-timeline-content">
                                                <h2>Coffee Break</h2>
                                                <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                                                <a href="#" class="btn btn-sm btn-info">Read more</a>
                                                <span class="vertical-date"> Yesterday <br><small>Dec 23</small></span>
                                            </div>
                                        </div>

                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon yellow-bg">
                                                <i class="fa fa-phone"></i>
                                            </div>

                                            <div class="vertical-timeline-content">
                                                <h2>Phone with Jeronimo</h2>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                                <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                                            </div>
                                        </div>

                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-comments"></i>
                                            </div>

                                            <div class="vertical-timeline-content">
                                                <h2>Chat with Monica and Sandra</h2>
                                                <p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                                                <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                                            </div>
                                        </div>
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
