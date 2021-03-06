<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Calendar')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.print.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<script type="text/javascript">
		function convertDate(t)
		{
			var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
			d.setUTCSeconds(t);
			document.write(d);
		}
	</script>
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
		                            <h5>Edit Event: {{ $event->title }}</h5>
		                            <div class="ibox-tools">
		                                {{-- <a href="/admin/calendar/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Event</a> --}}

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <input type="hidden" name="eventID" id="eventID" value="{{ $event->id }}">
                                        <input type="hidden" name="banner" id="banner" value="1">
                                        <input type="hidden" name="optGroupSelections" id="optGroupSelections" value="{{$optGroupSelections}}">
                                        <div class="form-group"><label class="col-sm-2 control-label">Title <span class="req">*</span></label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $event->title }}"></div>
                                        </div>

                                        @include('admin.includes.the-ultimate-store-selector')

                                        <div class="form-group"><label class="col-sm-2 control-label">Event Type <span class="req">*</span></label>
                                            <div class="col-sm-10" id="event-type-selector">
                                                <select class="form-control" id="event_type" name="event_type">
                                                    @foreach($event_types_list as $key=>$event_type)
                                                        @if( $key == $event->event_type )
                                                            <option value="{{ $key }}" selected>{{ $event_type}}</option>
                                                        @else
                                                            <option value="{{ $key }}">{{ $event_type}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End <span class="req">*</span></label>

                                                <div class="col-sm-5">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control datetimepicker-start" name="start" id="start" value="{{ $event->start }}" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control datetimepicker-end" name="end" id="end" value="{{ $event->end }}" />
                                                    </div>
                                                </div>
                                                @if($event->all_day == 1)
                                                    <label class="col-sm-2 control-label">All Day Event &nbsp;<input type="checkbox" class="" value="" id="all-day" name="all-day" checked /></label>
                                                @else
                                                    <label class="col-sm-2 control-label">All Day Event &nbsp;<input type="checkbox" class="" value="" id="all-day" name="all-day" /></label>
                                                @endif
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5" id="description" name="description">{{ $event->description }}</textarea>

                                            </div>
                                        </div>

                                    </form>


                                </div>
                            </div>
                            <div class="ibox">

                                <div class="ibox-title">
                                    <h5> Attachments </h5>
                                    <div class="ibox-tools">

                                        <div id="add-more-attachments" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add More Attachments</div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="form-group">


                                                <table class="table table-hover event-attachments-table">
                                                    <thead>
                                                        <tr>
                                                            <td>Folder</td>
                                                            <td>Updated</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($event_attachments as $attachment)

                                                        <tr class="event-attachments">
                                                            <td class="event-attachmentname" data-folderid = {{$attachment->global_folder_id}}><i class="fa fa-folder-o"></i> {{$attachment->name}} </td>
                                                            <td class="attachment-updated"> {{$attachment->updated_at}} </td>
                                                            <td><a data-folder-id="{{ $attachment->global_folder_id }}" id="folder{{$attachment->global_folder_id}}" class="remove-attachment btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                                        </tr>

                                                        @endforeach

                                                    </tbody>
                                                </table>



                                    </div>

                                    <div id="attachments-staged-to-remove">

                                    </div>

                                </div>
		                    </div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/calendar"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="event-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                </div>
                            </div>

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

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')

                <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
                <script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
                <script type="text/javascript" src="/js/custom/tree.js"></script>
                <script type="text/javascript" src="/js/custom/admin/events/editEvent.js"></script>
                <script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
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




				@include('site.includes.bugreport')




			</body>
			</html>
