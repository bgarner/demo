<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Communication')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
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
		                            <h5>Create a New Communication</h5>

		                            <div class="ibox-tools">

		                                <!-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> -->
		                            </div>
		                        </div>
		                        <div class="ibox-content">

									<form class="form-horizontal" id="createNewCommunicationForm">

										<input type="hidden" name="banner_id" value={{$banner->id}} >

										<div class="form-group">
											<label class="col-sm-2 control-label">Title</label>
								            <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value=""></div>
										</div>
										<div class="form-group">

								                <label class="col-sm-2 control-label">Start &amp; End</label>

								                <div class="col-sm-10">
								                    <div class="input-daterange input-group" id="datepicker">
								                        <input type="text" class="input-sm form-control datetimepicker-start" name="send_at" id="send_at" value="" />
								                        <span class="input-group-addon">to</span>
								                        <input type="text" class="input-sm form-control datetimepicker-end" name="archive_at" id="archive_at" value="" />
								                    </div>
								                </div>
								        </div>

										<div class="form-group" >
											<label class="col-sm-2 control-label">Type</label>
												<div class="col-sm-10" id="communication-type-selector">
													<div class="btn-group">
														<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
															<span class="selected_comm_type">Select</span>
															<i class="fa fa-angle-down"></i>
														</a>
														<input type="text" hidden  name="communication_type" value="">
														<ul name="communication_type" id="" class="dropdown-menu" role="menu">
															@foreach($communicationTypes as $ct)

																@if( ( $banner->id==1 && $ct->id == 1 ) || ($banner->id==2 && $ct->id == 2) )
																	<li data-comm-typeid="{{$ct->id}}"
																		data-comm-type="{{$ct->communication_type}}"
																		data-comm-typecolour="{{$ct->colour}}"
																		class="comm_type_dropdown_item" >
																		<a href="#"> {{$ct->communication_type}} </a>
																	</li>
																@else
																	<li data-comm-typeid="{{$ct->id}}"
																		data-comm-type="{{$ct->communication_type}}"
																		data-comm-typecolour="{{$ct->colour}}"
																		class="comm_type_dropdown_item" >
																		<a href="#" ><i class="fa fa-circle text-{{$ct->colour}}"></i> {{$ct->communication_type}}</a>
																	</li>
																@endif

															@endforeach
														</ul>
													</div>
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Body</label>
												<div class="col-sm-10">
													<textarea class="communication_body" name="body" cols="50" rows="10" id="body"></textarea>
												</div>
										</div>

										@include('admin.includes.store-banner-selector', ['optGroupOptions'=> $optGroupOptions, 'optGroupSelections' => $optGroupSelections])

									</form>

		                        </div> <!-- ibox-content closes -->

		                    </div><!-- ibox closes -->

		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Documents</h5>

		                            <div class="ibox-tools">

		                        	</div>


		                        </div>

		                        <div class="ibox-content">



					                <div class="input-group">
										<input type="text" class="form-control" name="seach_document" id="search_document" value="" placeholder="Search for document..."/>
										<span class="input-group-btn" >
											<div class="btn btn-primary" onclick="showDocumentListing()" >
											<i class="fa fa-plus"></i> Add documents</div>
										</span>
								    </div>
								    <div id="document-list"></div>



									<div id="files-selected">
                                    	<table class="table table-hover communication-documents-table hidden ">
                                    		<thead>
                                    			<tr>
                                    				<td>Title</td>
                                    				<td></td>
                                    				<td>Action</td>
                                    			</tr>
                                    		</thead>
                                    		<tbody>
                                    		</tbody>
                                    	</table>
                                    </div>

		                        </div>

		                    </div><!-- ibox closes-->

		                    <div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
									<button class="btn btn-primary communication-create"><i class="fa fa-check"></i> Send New Communication</button>
					            </div>
					        </div>

		                </div>
		            </div>


		        </div><!-- wrapper closes -->




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
		                <button type="button" class="btn btn-primary" id="attach-selected-files">Select Documents</button>
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
		                @include('admin.package.file-package-structure-partial', ['packages'=>$packages])
		                </ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id = "attach-selected-packages">Select Packages</button>
		            </div>
		        </div>
		    </div>
		</div>


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/admin/communications/addCommunication.js"></script>
		<script type="text/javascript" src="/js/custom/admin/communications/documentSelector.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>

		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

			$(".date").datetimepicker({
		          format: 'YYYY-MM-DD HH:mm:ss'
		    });

		    $(".chosen").chosen({
				  width:'75%'
			});

		   	CKEDITOR.replace('body', {

    		    filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

    		});

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

		    $("#add-packages").click(function(){
		    	$("#package-listing").modal('show');
		    });

		    $(".comm_type_dropdown_item").click(function(){
		    	$(".selected_comm_type").empty();
		    	var comm_typeid = $(this).attr('data-comm-typeid');
		    	var comm_typeColour = $(this).attr('data-comm-typecolour');
		    	var comm_type = $(this).attr('data-comm-type');
		    	$("input[name='communication_type']").val(comm_typeid);
		    	$(".selected_comm_type").append('<i class="fa fa-circle text-'+ comm_typeColour + '"> </i> '+ comm_type);
		    })

		</script>

	</body>
	</html>
