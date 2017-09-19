<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Alert')
    @include('admin.includes.head')
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
		                            <h5>New Alert</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/calendar/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add Alert</a> --}}

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Document <span class="req">*</span></label>
                                           <!--  <div class="col-sm-4">

                                                <input type="text" id="alert_document" name="alert_document" class="form-control">
                                            </div> -->
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="alert_document" id="search_document" value="" placeholder="Search for document..."/>
                                                    <span class="input-group-btn" >
                                                        <div class="btn btn-primary" onclick="showDocumentListing()" >
                                                        <i class="fa fa-plus"></i> Add documents</div>
                                                    </span>
                                                </div>
                                                <div id="document-list"></div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2"> Alert Type <span class="req">*</span></label>
                                            <div class="col-sm-3">
                                                @if( isset($alert_details->id) )
                                                    {!! Form::select('alert_type', $alert_types, $alert_details->alert_type_id ,['class'=> 'form-control', 'id'=>'alert_type']) !!}
                                                @else
                                                    {!! Form::select('alert_type', $alert_types, null ,['class'=> 'form-control', 'id'=>'alert_type']) !!}
                                                @endif
                                            </div>
                                        </div>





                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/alert"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="alert-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Alert</button>

                                            </div>
                                        </div>
                                    </form>


                                </div>
		                    </div>

		                </div>

                    </div>
            </div>

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



	</div>


		        </div>

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')



				<script src="/js/custom/admin/alerts/addAlert.js"></script>
                <script type="text/javascript" src="/js/custom/tree.js"></script>
                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});
                </script>

				@include('site.includes.bugreport')

			</body>
			</html>
