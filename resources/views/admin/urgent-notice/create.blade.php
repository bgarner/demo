<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Urgent Notice')
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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Create an Urgent Notice</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/urgentnotice">Urgent Notice</a>
                        </li>
                        <li class="active">
                            <strong>Create an Urgent Notice</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>New Urgent Notice</h5>
		                            <div class="ibox-tools">

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

                                    <form method="get" class="form-horizontal" id="createNewUrgentNoticeForm">

                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">
                                        <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10"><textarea id="description" name="description" class="form-control" value=""></textarea></div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                         <div class="form-group"><label class="col-sm-2 control-label">Attachment Type</label>
                                            <div class="col-md-10">
                                               @foreach($attachment_types as $atype)
                                               <?php $id = "attachment-" . $atype->name ?>
                                               	<div>{!! Form::input('radio', 'attachment_type', $atype->id , ['id'=> $id ]) !!} {{$atype->name}}</div>
                                               @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group hidden"><label class="col-sm-2 control-label">Attachment Selected</label>
                                            <div class="col-md-10" id="attachment-selected">

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control datetimepicker-start" name="start" id="start" value="" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control datetimepicker-end" name="end" id="end" value="" />
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Target Stores</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                                {!! Form::label('allStores', 'Or select all stores:') !!}
                                                {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
                                            </div>

                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/urgentnotice"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="urgentnotice-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Urgent Notice</button>

                                            </div>
                                        </div>

                                    </form>


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
            </div>
	</div>


</div>

@include('site.includes.footer')

@include('admin.includes.scripts')

@include('site.includes.bugreport')




<script type="text/javascript" src="/js/custom/admin/urgent-notices/addUrgentNotice.js"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
<script type="text/javascript" src="/js/custom/tree.js"></script>
<script type="text/javascript" src="/js/custom/datetimepicker.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".chosen").chosen({
        width:'75%'
    })
    // $('.input-daterange').datepicker({
    //      format: 'yyyy-mm-dd',
    //     keyboardNavigation: false,
    //     forceParse: false,
    //     autoclose: true
    // });
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"
    });

    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

</script>


</body>
</html>
