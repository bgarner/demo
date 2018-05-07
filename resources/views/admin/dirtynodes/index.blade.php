<!DOCTYPE html>
<html>

<head>
    @section('title', 'Cleaned Nodes')
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
		                            <h5>Cleaned Nodes <small>(displaying nodes cleaned in last 24 hours)</small></h5>

		                            <div class="ibox-tools">
										<input type="checkbox" id="domfields" /> DOM IT Fields Only
		                            	<a id="generate_cleaned_nodes_report" class="btn btn-primary btn"> Generate Report</a>
		                            	<a id="advanced_report" class="btn btn-primary btn"> Advanced</a>
		                            </div>

		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover table-striped dirtynodestable" id="">
		                                    <thead>
		                                    <tr>
		                                        <th style="display: none;">ID</th>
		                                        
		                                        <th>Store Number</th>
		                                        <th>Style</th>
		                                        <th>UPC</th>
		                                        <th>Desc</th>
		                                        <th>Color</th>
		                                        <th>Size</th>
		                                        <th>Start</th>
		                                        {{--  <th>Week</th>  --}}
		                                        <th>Qty</th>
		                                        <th>Cleaned At</th>

		                                    </tr>
		                                    </thead>

		                                    <tbody>
		                                        @foreach($data as $d)
		                                        <tr id="nodeID_{{ $d->id }}">
		                                            <td style="display: none;">{{ $d->id }}</td>
		                                           
		                                            <td>{{ $d->store }}</td>
		                                            <td>{{ $d->stylecode }}</td>
		                                            <td>{{ $d->upccode }}</td>
		                                            <td>{{ $d->styledesc }}</td>
		                                            <td>{{ $d->color }}</td>
		                                            <td>{{ $d->sizename }}</td>
		                                            <td>{{ $d->startdate }}</td>
		                                            {{--  <td>{{ $d->week }}</td>  --}}
		                                            <td>{{ $d->quantity }}</td>
		                                            <td>{{ $d->updated_at }}</td>
		                                        
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

				<div id="advanced_report_modal" class="modal inmodal fade">
		            <div class="modal-dialog">
		                <div class="modal-content">
		                	
		                    <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                        <h4 class="modal-title">Select date range</h4>
		                    </div>
		                    <div class="modal-body">

		                    	<div class="form-group">
		                        	<div class="input-daterange input-group" id="datepicker">
					                        <input type="text" class="input-sm form-control datetimepicker-start" name="start_date" id="start_date" value="" />
					                        <span class="input-group-addon">to</span>
					                        <input type="text" class="input-sm form-control datetimepicker-end" name="end_date" id="end_date" value="" />
					                    </div>
		                        </div>

		                    </div>
		                    <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                        <button type="submit" class="btn btn-primary" id="generate_advanced_report">Generate Report</button>
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
				<script src="/js/custom/admin/dirtynodes/generateReport.js"></script>
				<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
				<script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
				@include('site.includes.bugreport')


			</body>
			</html>
