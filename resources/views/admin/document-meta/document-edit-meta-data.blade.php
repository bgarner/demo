<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <link href="/js/plugins/fileinput/fileinput.css" rel="stylesheet">
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

        <div id="page-wrapper" class="gray-bg">

            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">

                            <div class="ibox-title">
                                <h5>Document Details</h5>
                                <div class="ibox-tools">
                                    {!! $document->modalLink !!}
                                </div>
                            </div>
                            <div class="ibox-content">
                                    <form method="get" class="form-horizontal" >
                                        <input type="hidden" name="documentID" id="documentID" value="{{ $document->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Title <span class="req">*</span></label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $document->title }}"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2"> Current Folder </label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span id="folder-path" class="input-sm form-control">{{$folderPath}}</span>
                                                    <span class="btn input-group-addon" id="folder-select"><i class="fa fa-folder-open"></i> Change</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Start <span class="req">*</span> &amp; End</label>

                                            <div class="col-sm-10">
                                                <div class="input-daterange input-group" id="datepicker">

                                                    <input type="text" class="input-sm form-control datetimepicker-start" name="document_start" id="document_start" value="{{$document->start}}" />
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" class="input-sm form-control datetimepicker-end" name="document_end" id="document_end" value="{{$document->end}}" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Target Stores <span class="req">*</span></label>
                                            <div class="col-sm-10">
                                                @if($document->all_stores)
                                                    {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                                    {!! Form::label('allStores', 'Or select all stores:') !!}
                                                    {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
                                                @else
                                                    {!! Form::select('stores', $storeList, $target_stores, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                                    {!! Form::label('allStores', 'Or select all stores:') !!}
                                                    {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
                                                @endif
                                               {{--
                                               <select name="stores" id="storeSelect" multiple class="chosen">
                                                    <option value="">Select Some Options</option>
                                                    @foreach($storeAndStoreGroups as $option)

                                                        <option value="{{$option['id']}}"

                                                            @if(isset($option["isStoreGroup"]))
                                                                data-isStoreGroup = "{{$option['isStoreGroup']}}"
                                                            @endif
                                                            @if(isset($option["stores"]))
                                                                data-stores = "{{$option['stores']}}"
                                                            @endif

                                                            @if(in_array($option['id'], $target_stores))
                                                                selected
                                                            @endif

                                                        >
                                                            {{$option['name']}}
                                                        </option>

                                                    @endforeach

                                                </select>


                                                @if($document->all_stores)

                                                    {!! Form::label('allStores', 'Or select all stores:') !!}
                                                    {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
                                                @else

                                                    {!! Form::label('allStores', 'Or select all stores:') !!}
                                                    {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
                                                @endif
                                                --}}
                                            </div>


                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> This document is an alert</label>
                                            <div class="col-sm-1">
                                                @if( isset($alert_details->id))
                                                <input type="checkbox" id="is_alert" name="is_alert" value=1 checked>
                                                @else
                                                <input type="checkbox" id="is_alert" name="is_alert" value=1>
                                                @endif

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

                                        <div class="form-group" id="tag-selector-container">
                                            @include('admin.tag.tag-partial', ['tags'=>$tags, 'selectedTags'=>$selectedTags])
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/alert"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="alert-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Save changes</span></button>

                                            </div>
                                        </div>
                                    </form>
                            </div><!-- ibox content closes -->

                        </div> <!-- ibox closes -->

                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Update Document</h5>

                            </div>

                            <div class="ibox-content">


                                <div class="row">
                                     <label class="control-label col-sm-2"> New Document </label>
                                    <div class="col-sm-10">

                                        <input id="updatedDocument" name="updatedDocument[]" type="file" multiple class="file-loading">
                                        <input type="hidden" value="{{ $document->id }}" name="document_id" id="document_id">

                                    </div>

                                </div>


                            </div>

                        </div><!-- ibox closes-->

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

      <script src="/js/custom/datetimepicker.js"></script>

    <script type="text/javascript">
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

    </script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script src="/js/plugins/fileinput/fileinput.js"></script>
    <script type="text/javascript">
        $(".chosen").chosen({
          width:'75%'
        });
        $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

        $("#updatedDocument").fileinput();

    </script>
    <script type="text/javascript" src="/js/custom/admin/alerts/createAlert.js"></script>
    <script type="text/javascript" src="/js/plugins/select/select2.min.js"></script>
    <script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script>
    <!--<script type="text/javascript" src="/js/custom/admin/global/storeAndStoreGroupSelector.js"></script>-->
    <script type="text/javascript" src="/js/custom/admin/documents/changeFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/replaceDocument.js"></script>
    <script type="text/javascript" src="/js/custom/site/launchModal.js"></script>
    <script type="text/javascript" src="/js/custom/admin/tags/addTagToContent.js"></script>
    @include('site.includes.bugreport')
    @include('site.includes.modal')

</body>
</html>

