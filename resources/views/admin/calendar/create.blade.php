<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Calendar')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id=" ">
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
		                            <h5>New Event</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/calendar/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Event</a> --}}

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

                                    <form method="get" class="form-horizontal" id="createNewEventForm">
                                        <input type="hidden" name="banner" id="banner" value="1">
                                        <div class="form-group"><label class="col-sm-2 control-label">Title <span class="req">*</span></label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Event Type <span class="req">*</span></label>
                                            <div class="col-sm-10">
                                                {{-- <input type="text" class="form-control" value="{{ $event_type->event_type }}"> --}}

                                                <select class="form-control" id="event_type" name="event_type">
                                                    @foreach($event_types_list as $key=>$event_type)

                                                            <option value="{{ $key }}">{{ $event_type}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="summernote"></div> --}}
                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End <span class="req">*</span></label>

                                                <div class="col-sm-5">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control datetimepicker-start" name="start" id="start" value="" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control datetimepicker-end" name="end" id="end" value="" />
                                                    </div>
                                                </div>

                                                <label class="col-sm-2 control-label">All Day Event &nbsp;<input type="checkbox" class="" value="1" id="all-day" name="all-day" /></label>



                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5" id="description" name="description"></textarea>

                                            </div>
                                        </div>

                                        @include('admin.includes.store-banner-selector', ['optGroupOptions'=> $optGroupOptions, 'optGroupSelections' => $optGroupSelections])

                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <div id="add-folders" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add folders</div>
                                            </div>
                                        </div>
                                        <div id="folders-selected" class="col-sm-offset-2"></div>

                                        <div class="hr-line-dashed"></div>


                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/calendar"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="event-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Create New Event</span></button>

                                            </div>
                                        </div>
                                    </form>


                                </div>
		                    </div>

		                </div>

                    </div>
            </div>
            <div id="folder-listing" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Select Folders</h4>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="attach-selected-folders">Select Folders</button>
                        </div>
                    </div>
                </div>
            </div>
	</div>


		        </div>

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')

				@include('site.includes.bugreport')


                <script type="text/javascript" src="/js/custom/admin/events/addEvent.js"></script>
                <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
                <script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
                <script type="text/javascript" src="/js/custom/tree.js"></script>
                <script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
                <script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>


                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(".chosen").chosen({
                        width:'75%'
                    });


                    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

                    CKEDITOR.replace('description', {
                        filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

                    });

                </script>


			</body>
			</html>
