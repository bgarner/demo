<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Quicklink')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
	body .modal-ql-file{
    width: 100%; /* respsonsive width */
    margin: 0 auto;
/*    margin-left:-40%; */

	}

	body .modal-ql-file .modal-content{
		width: 900px !important;
		margin-left:-150px;
		padding-right: 10px;
		height: 700px !important;
		/*margin: 0 auto;*/
	}

	body .modal-ql-file .modal-body{
		padding-left: 20px !important;
		padding-right: 20px !important;
	}

	.modal-ql-file .ibox-title{
		border: thin solid lime;
		padding: 0px !important;
		min-height: 0px !important;
	}

	.ql-filetable td, .ql-filetable thead{
		font-size: 12px !important;
	}

	/*.modal-ql-file .ibox-title{ border: none; padding: 0px; }*/
	.modal-ql-file h6{ font-size: 16px !important; font-weight: normal; }

	#valid-url{ font-size: 20px; }
	.red{ color: #c00; }
	.green{ color: #0c0; }
	.link-test{ display: none; }
	</style>
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
		                            <h5>New Quicklink</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/quicklink/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Package</a> --}}

		                            </div>
		                        </div>
		                        <div class="ibox-content">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="get" class="form-horizontal" id="createNewQuicklinkForm">

                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">
                                        <div class="form-group"><label class="col-sm-2 control-label">Name <span class="req">*</span></label>
                                            <div class="col-sm-10"><input type="text" id="name" name="name" class="form-control" value=""></div>
                                        </div>



                                        <div class="form-group"><label class="col-sm-2 control-label">Quicklink type <span class="req">*</span></label>
                                            <div class="col-md-10">
                                        		<div class="btn-group" role="group" data-toggle="buttons">
													@foreach($quicklink_types as $qtype)
		                                            	<label class="btn btn-outline btn-default" id="quicklink-{{$qtype->name}}">
		                                               		<input type="radio" name="link-type" value="{{ $qtype->id }}">{{$qtype->name}}
		                                               	</label>
													@endforeach
                                            	</div>
                                            </div>
                                        </div>



                                        <div class="form-group"><label class="col-sm-2 control-label">Quicklink URL</label>
                                            <div class="col-md-10" id="quicklink-url"></div>
                                            <input type="hidden" id="url" name="url" value="" />
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/dashboard"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="quicklink-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Quicklink</button>

                                            </div>
                                        </div>

                                    </form>


                                </div>
		                    </div>

		                    <div id="document-listing" class="modal modal-ql-file fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Select a Document</h4>
							            </div>
							            <div class="modal-body">
								           <div class="row">

									           <div class="col-md-4" style="direction:rtl;max-height:500px;overflow:auto;">

						                            <div class="file-manager" style="direction:ltr;">

						                                <span class="top-level-folder"> <h5><i class="fa fa-folder"></i> {{$banner->name}}</h5> </span>
						                                    @include('admin.navigation-view', ['navigation'=>$navigation])
						                                    <div id="file-container" class="hidden">
						                                    <ol class="breadcrumbs"></ol>
						                                    <input type="hidden" name="default_folder" value="">
						                                    <input type="hidden" name="banner_id" value={{$banner->id}}>
						                                    </div>
						                                    <div id="package-viewer" class="hidden">
						                                    @include('admin.package.view')
						                                    </div>


						                                <div class="clearfix"></div>
						                            </div>
												</div>

												<div class="col-md-8" style="max-height:500px;overflow:auto;">
													<div class="">
                                        				<h6 id="folder-title"></h6>
                                       			 		<div class="ibox-tools"></div>
                                    				</div>
												    <div class="ibox-content">
				                                        <table class="table tablesorter ql-filetable" id="file-table"></table>
				                                    </div>
												</div>
											</div> <!-- end row -->
							            </div>
							            <div class="modal-footer">
							             	<input type="hidden" id="selected_file_id" name="selected_file_id" value="">
							            	<h4 class="pull-left">Selected File:&nbsp;&nbsp;<span id="ql-doc-selected"><span></h4>
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="attach-selected-files"><i class="fa fa-check"></i> Select Document</button>
							            </div>
							        </div>
							    </div>
							</div>

							<div id="folder-listing" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Select Folder</h4>
							            </div>
							            <div class="modal-body">
							            	<ul class="tree">
							            	@foreach ($folderStructure as $folder)

												@if (isset($folder["is_child"]) && ($folder["is_child"] == 0) )

													@include('admin.package.folder-structure-partial', ['folderStructure' =>$folderStructure, 'currentnode' => $folder])

												@endif


											@endforeach
											</ul>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="attach-selected-folders"><i class="fa fa-check"></i> Select Folder</button>
							            </div>
							        </div>
							    </div>
							</div>

							<div id="external" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Add External URL</h4>
							            </div>
							            <div class="modal-body">
							            	<div class="row">
							            		<label class="col-sm-2 control-label">URL</label>
							            		<div class="col-sm-8"><input type="text" id="external-url" class="form-control"></div>
							            		<div class="col-sm-2" id="valid-url"><i class="fa"></i></div>
							            	</div>
							            	<div class="row" style="padding: 10px 0px;">
							            		<label class="col-sm-2 control-label link-test">Test</label>
							            		<div class="col-sm-8 link-test" id="test-link"></div>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="add-external-url" disabled><i class="fa fa-check"></i> Done</button>
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

@include('site.includes.bugreport')

<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/custom/admin/folders/folderStructureQL.js" ></script>
<script type="text/javascript" src="/js/custom/admin/documents/fileTableQL.js"></script>
<script type="text/javascript" src="/js/custom/admin/quicklinks/addQuicklink.js"></script>
<script type="text/javascript" src="/js/custom/tree.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.input-daterange').datepicker({
         format: 'yyyy-mm-dd',
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

 	$("#external-url").on("change keyup", function() {
 		var urlString = $(this).val();
 		var isValid = learnRegExp(urlString);
 		console.log(isValid);
	    if (isValid){
	    	 $("#valid-url .fa").removeClass("fa-times");
	    	 $("#valid-url .fa").removeClass("red");
	         $("#valid-url .fa").addClass("fa-check");
	         $("#valid-url .fa").addClass("green");
	         $(".link-test").show();
	         $("#test-link").html("<a href='"+urlString+"' target='_blank'>"+urlString+"</a>");
	         $("#add-external-url").attr("disabled", false);
	    } else {
	    	$("#valid-url .fa").removeClass("fa-check");
	    	$("#valid-url .fa").removeClass("green");
	    	$("#valid-url .fa").addClass("fa-times");
	    	$("#valid-url .fa").addClass("red");
	    	$(".link-test").hide();
	    	$("#test-link").empty();
	    	$("#add-external-url").attr("disabled", true);
	    }
	});
 //    $("#external-url").on("change keyup", function() {
 //    	$('#validate').toggleClass('validate', ValidURL(this.value));
	// });


 function learnRegExp(s) {
 		console.log(s);
      var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
      return regexp.test(s);
 }

</script>


</body>
</html>
