<!DOCTYPE html>
<html>

<head>
    @section('title', 'Forms')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	{{-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> --}}
	<style>
        .modal-dialog{
            height: 380px;
        }

    </style>
</head>

<body class="fixed-navigation adminview">
    <input type="text" hidden value="{{$formInstance->id}}" id="form_instance_id">
    <input type="text" hidden value="admin" id="origin">


    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >


		<div class="wrapper wrapper-content animated fadeInRight">
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

                    <div class="row">
                        <div class="col-md-6">

                            <div class="ibox">
                                <div class="ibox-title">
                                	<h2>Update Progress on this Request</h2>
                                </div>

                                <div class="ibox-content">
                                    <label>Status</label>
                                        <select class="form-control" id="status_code_id">
                                            <option value=""></option>
                                            @foreach($codes as $code)
                                            <option value="{{$code->id}}">{{$code->admin_status}}</option>
                                            @endforeach
                                        </select>

                                    <label>Comments</label>
                                    <textarea class="form-control" id="comment"></textarea>

                                    <button id="update_status" type="submit" class="btn btn-md btn-primary pull-right clearfix" style="margin: 10px 0px 10px 0px;">Submit</button>
                                    <br />
                                    <br class="clearfix" />
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                                <div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon green-bg">
                                        <i class="fa fa-paper-plane"></i>
                                    </div>

                                    <div class="vertical-timeline-content">
                                        <h2>Submitted</h2>
                                        {{-- <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                        </p> --}}
                                        {{-- <a href="#" class="btn btn-sm btn-success"> More info</a> --}}
                                            <span class="">
                                                <small>
                                                {{ $formInstance->form_data['submitted_by'] }} - {{ $formInstance->form_data['submitted_by_position'] }}<br / />
                                                <div class="pull-left">{{ $formInstance->sinceSubmitted }} ago</div>
                                                <div class="pull-right">{{ $formInstance->prettySubmitted }}</div>
                                                </small>
                                            </span>
                                    </div>
                                </div>

                                <div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon blue-bg">
                                        <i class="fa fa-clock-o"></i>
                                    </div>

                                    <div class="vertical-timeline-content">

                                        <h2>In Progress</h2>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        <P><em>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                            </em>
                                        </P>
                                        {{-- <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                        </p> --}}
                                        {{-- <a href="#" class="btn btn-sm btn-success"> More info</a> --}}
                                            <span class="">
                                                <small>Steve Smith - Hardgoods Analyst<br / />
                                                <div class="pull-left">{{ $formInstance->sinceSubmitted }} ago</div>
                                                <div class="pull-right">{{ $formInstance->prettySubmitted }}</div>
                                                </small>
                                            </span>
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

        <script type="text/javascript" src="/js/custom/forms/formStatus.js"></script>



		<script>
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});



		</script>


		@include('site.includes.modal')
        @include('admin.folder.foldermodal')

	</body>
	</html>
