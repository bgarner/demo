<!DOCTYPE html>
<html>

<head>
    @section('title', 'Features')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
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
                            <h5>Create a New Feature</h5>

                        </div>
                        <div class="ibox-content">
                        	<form method="get" class="form-horizontal" id="createNewFeatureForm" enctype="multipart/form-data">

                                <input type="hidden" name="banner_id" value="{{$banner->id}}">
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Feature Title <span class="req">*</span></label>
                                    <div class="col-sm-10"><input type="text" id="feature_title" name="feature_title" class="form-control" value=""></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tile Label</label>
                                    <div class="col-sm-10"><input type="text" id="tile_label" name="tile_label" class="form-control" value=""></div>
                                </div>
                                <div class="form-group">

                                        <label class="col-sm-2 control-label">Start &amp; End <span class="req">*</span></label>

                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control datetimepicker-start" name="start" id="start" value="" />
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="input-sm form-control datetimepicker-end" name="end" id="end" value="" />
                                            </div>
                                        </div>
                                </div>

								@include('admin.includes.store-banner-selector', ['optGroupOptions'=> $optGroupOptions, 'optGroupSelections' => $optGroupSelections])

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Thumbnail <span class="req">*</span></label>
                                	<div class="col-md-10"><input type="file" name="thumbnail" id="thumbnail" class="form-control "></div>

                                </div>

                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Background Image <span class="req">*</span></label>
                                	<div class="col-md-10"><input type="file" name="background" id="background" class="form-control "></div>
                                    <div class="col-sm-10"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Documents</h5>

                            <div class="ibox-tools">
                            	<div class="btn btn-primary btn-outline" type="button" role="button" id="add-documents" >
                            		<i class="fa fa-plus"></i> Add Documents
                            	</div>

                            </div>
                        </div>
                        <div class="ibox-content">

                            <div id="files-selected">
                            	<table class="table table-hover feature-documents-table hidden ">
                            		<thead>
                            			<tr>
                            				<td>Title</td>
                            				<td></td>
                            				<td class="align-right">Action</td>
                            			</tr>
                            		</thead>
                            		<tbody>
                            		</tbody>
                            	</table>
                            </div>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Packages</h5>

                            <div class="ibox-tools">
                            	<div class="btn btn-primary btn-outline" type="button" id="add-packages" role="button"><i class="fa fa-plus"></i> Add Packages </div>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div id="packages-selected">
                            	<table class="table table-hover feature-packages-table hidden">
                            		<thead>
                            			<tr>
                            				<td>Package Name</td>
                            				<td></td>
                            				<td class="align-right">Action</td>
                            			</tr>
                            		</thead>
                            		<tbody>
                            		</tbody>

                            	</table>

                            </div>
                        </div>
                    </div>

					<div class="ibox">
                    	<div class="ibox-title">
                    		<h5> Flyers </h5>
                    		<div class="ibox-tools">

                    			<div id="add-flyers" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add Flyers</div>
                    		</div>
                    	</div>
                    	<div class="ibox-content">
							<div id="flyers-selected">
								<table class="table table-hover feature-flyers-table hidden">
                            		<thead>
                            			<tr>
                            				<th>Flyer Name</th>
											<th></th>
											<th class="align-right">Action</th>
                            			</tr>
                            		</thead>
                            		<tbody>
                            		</tbody>

                            	</table>
							</div>
						</div> <!-- ibox content closes -->
					</div>


                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Communications</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

                        	<div class="row">
	                        	<div class="form-group">
                                	<label class="col-sm-2 control-label">Communication Types</label>
                                	<div class="col-md-10">

                                		{!! Form::select('communicationTypes[]', $communicationTypes, null, ['class'=>'chosen', 'multiple'=>'multiple', 'id'=>'communicationTypes']) !!}
                                	</div>
                                </div>
                            </div>

							<div class="row">
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Communications</label>
                                	<div class="col-md-10">

                                		{!! Form::select('communications[]', $communications, null, ['class'=>'chosen', 'multiple'=>'multiple', 'id'=>'communications']) !!}
                                	</div>
                                </div>
                            </div>


                            <br>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Events</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Event Types</label>
                                    <div class="col-md-10">

                                        {!! Form::select('eventTypes[]', $eventTypes, null, ['class'=>'chosen', 'multiple'=>'multiple', 'id'=>'eventTypes']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Events</label>
                                    <div class="col-md-10">

                                        {!! Form::select('events[]', $events, null, ['class'=>'chosen', 'multiple'=>'multiple', 'id'=>'events']) !!}
                                    </div>
                                </div>
                            </div>


                            <br>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tasklists</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tasklists</label>
                                    <div class="col-md-10">

                                        {!! Form::select('tasklists[]', $tasklists, null, ['class'=>'chosen', 'multiple'=>'multiple', 'id'=>'tasklists']) !!}
                                    </div>
                                </div>
                            </div>

                            <br>
                        </div>
                    </div>


                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Notifications</h5>

                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                            	<div class="row">
                            		<label class="col-sm-2 control-label">Latest Updates <span class="req">*</span></label>

									<div class="latest-updates-container col-sm-10">
										<div class="latest-update-option ">
											{!! Form::radio('latest_updates_option', '1') !!} By Days
											{!! Form::input('text', 'update_frequency', null, [ 'class' => 'update_frequency', 'disabled'=> 'disabled', 'placeholder'=>'Number of Days']) !!}
										</div>
										<div class="latest-update-option ">
											{!! Form::radio('latest_updates_option', '2') !!} By Documents
											{!! Form::input('text', 'update_frequency', null, [ 'class' => 'update_frequency','disabled'=> 'disabled', 'placeholder'=>'Number of Documents']) !!}
										</div>

									</div>

                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <a class="btn btn-white" href="/admin/feature"><i class="fa fa-close"></i> Cancel</a>
                            <button class="feature-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Feature</button>

                        </div>
                    </div>

                </div>
            </div>


        </div>
        </div>

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')





		@include('site.includes.bugreport')

		<div id="document-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Documents</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
		            	@foreach ($navigation as $nav)

							@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )

								@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])

							@endif

						@endforeach
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" data-dismiss="modal" id="attach-selected-files">Select Documents</button>
		            </div>
		        </div>
		    </div>
		</div>

		<div id="package-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Packages</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
						@include('admin.package.package-structure-partial', ['packages' =>$packages])
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" data-dismiss="modal" class="btn btn-primary attach-selected-packages" id="attach-selected-packages">Select Packages</button>
		            </div>
		        </div>
		    </div>
		</div>

		<div id="flyer-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Flyers</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
						@include('admin.flyer.flyer-listing-partial', ['flyers' =>$flyers])
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" data-dismiss="modal" class="btn btn-primary attach-selected-flyers" id="attach-selected-flyers">Select Flyers</button>
		            </div>
		        </div>
		    </div>
		</div>



		<script type="text/javascript" src="/js/custom/admin/features/addFeature.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>
		<script src="/js/custom/datetimepicker.js"></script>

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});


            $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

            $(".chosen").chosen({
            	'width':'100%'
            });

		</script>


	</body>
	</html>
