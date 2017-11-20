<!DOCTYPE html>
<html>

<head>
    @section('title', 'Edit Communication')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <link rel="stylesheet" href="/css/plugins/select/select2.min.css">
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
                            <h5>Edit Communication: {{ $communication->subject }}</h5>

                            <div class="ibox-tools">
                            </div>
                        </div>
                        <div class="ibox-content">



							<form class="form-horizontal" id="updateCommunicationForm">

								<input type="hidden" name="banner_id" value={{$banner->id}} >
								<input type="hidden" id="communicationId" name="communicationId" value={{$communication->id}}>
								<input type="hidden" name="optGroupSelections" id="optGroupSelections" value="{{$optGroupSelections}}">

								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
						            <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value="{{ $communication->subject }}"></div>
								</div>

								<div class="form-group">

			                        <label class="col-sm-2 control-label">Start &amp; End</label>

			                        <div class="col-sm-10">
			                            <div class="input-daterange input-group" id="datepicker">
			                                <input type="text" class="input-sm form-control datetimepicker-start" name="send_at" id="send_at" value="{{$communication->send_at}}" />
			                                <span class="input-group-addon">to</span>
			                                <input type="text" class="input-sm form-control datetimepicker-end" name="archive_at" id="archive_at" value="{{$communication->archive_at}}" />
			                            </div>
			                        </div>
				                </div>
	                			@include('admin.includes.the-ultimate-store-selector')
								<div class="form-group">

									<label class="col-sm-2 control-label">Type</label>
										<div class="col-sm-10" id="communication-type-selector">
											@include('admin.communication.communication-type-selector')
										</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Body</label>
										<div class="col-sm-10">
											<textarea class="communication_body" name="body" cols="50" rows="10" id="body">
												{{ $communication->body }}

											</textarea>

										</div>
								</div>	
                <div id="tag-selector-container">
                    @include('admin.tag.tag-partial', ['tags'=>$tags, 'selectedTags'=>$selectedTags])
                </div>


							</form>




                        </div> <!--  ibox content closes-->


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
                        		@include('admin.communication.document-partial', ['communication_documents'=>$communication_documents])
							</div>
							<div id="files-staged-to-remove"></div>

                        </div>

                    </div><!-- ibox closes-->
                    <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
							<button class="btn btn-primary communication-update"><i class="fa fa-check"></i> Update Communication</button>
			            </div>
			        </div>

                </div> <!-- col-lg-12 closes -->
            </div><!-- row closes -->


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


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

	    @include('site.includes.bugreport')

		<script type="text/javascript" src="/js/custom/admin/communications/editCommunication.js"></script>
		<script type="text/javascript" src="/js/custom/admin/communications/documentSelector.js"></script>
		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>
		<script type="text/javascript" src="/js/plugins/select/select2.min.js"></script>



		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		    $(".chosen").chosen({
				  width:'75%'
			});

		   CKEDITOR.replace('body', {
    		    filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

    		});

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

		    $(document).ready(function(){
		    	initializeTagSelector();
		    });

		</script>

	</body>
	</html>
