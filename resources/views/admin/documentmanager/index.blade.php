<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document Manager')
    @include('admin.includes.head')
    <style type="text/css">

        .action{
            white-space: nowrap;
        }

        .top-level-folder{
            color: #444;
        }



    </style>
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview" onload="checkDeepLink()">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('admin.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="file-manager">

                                <a href="/admin/document/manager" class="top-level-folder"> <h5><i class="fa fa-folder"></i> {{$banner->name}}</h5> </a>
                                    @include('admin.navigation-view', ['navigation'=>$navigation])
                                    <div id="file-container" class="hidden">
                                    <ol class="breadcrumbs"></ol>
                                    <input type="hidden" name="default_folder" value={{$defaultFolder}}>
                                    <input type="hidden" name="banner_id" value={{$banner->id}}>
                                    <input type="hidden" name="allChildFolderCount" id="allChildFolderCount" >
                                    <input type="hidden" name="allDocumentsInFolderCount" id="allDocumentsInFolderCount">
                                    <input type="hidden" name="folderNameForDeleteModal" id="folderNameForDeleteModal">
                                    </div>
                                    <div id="package-viewer" class="hidden">
                                    @include('admin.package.view')
                                    </div>


                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-xs-6 animated fadeInRight">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                            <div id="file-container" class="" style="height: 100%; width: 100%;">

                                <div class="ibox float-e-margins">


                                    <div class="ibox-title">

                                        <h5 id="folder-title"> <i class="fa fa-folder-open"></i> {{$banner->name}}</h5>

                                        <div class="ibox-tools">

                                            <span class="dropdown" id="edit_multiple_documents" >
                                                <button class="btn btn-warning dropdown-toggle" type="button" id="edit_selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Edit Selected
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="edit_selected">
                                                    <li id="edit_start_date"><a>Start Date</a></li>
                                                    <li id="edit_end_date"><a>End Date</a></li>
                                                    <li id="delete-multiple"><a>Delete</a></li>
                                                </ul>
                                            </span>
                                            <a id="add-files" class="hidden" data-folderId="" href="/admin/document/create" title="Add Documents">
                                                <button type="button" class="btn btn-primary btn-outline">
                                                    <i class="fa fa-plus"></i> <i class="fa fa-file-o"></i>
                                                </button>
                                            </a>
                                            <a id="add-folder" href="/admin/folder/create" title="Add Folder">
                                                <button type="button" class="btn btn-primary btn-outline">
                                                    <i class="fa fa-plus"></i> <i class="fa fa-folder"></i>
                                                </button>
                                            </a>
                                            <a id="edit-folder" class="hidden" href="" title="Edit Folder">
                                                <button type="button" class="btn btn-primary btn-outline"><i class="fa fa-pencil"></i></button>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-outline" id="copy-folder" ><i class="fa fa-clipboard" title="Copy Folder"></i></button>
                                            <a id="delete-folder" class="hidden" href="" title="Delete Folder">
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a>


                                        </div>
                                    </div>


                                    <div class="ibox-content">
                                            <table class="table tablesorter" id="file-table">
                                            </table>
                                    </div>
                                    <div>
                                    @if(isset($errors))
                                        @foreach($errors as $e)
                                        <div class="folder-create-errors" data-error="{{$e}}"> </div>
                                        @endforeach
                                    @endif
                                    </div>



                                </div> <!-- ibox closes -->


                            </div> <!-- file-container closes -->
                        </div>


                    </div> <!-- row closes -->


                </div>

                <div id="start_date_selector" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Start Date</h4>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="input-sm form-control datetimepicker-start" name="start_date" id="start_date" value="" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update_start_date">Update Start Date</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="end_date_selector" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">End Date</h4>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="input-sm form-control datetimepicker-end" name="end_date" id="end_date" value="" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update_end_date">Update End Date</button>
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


    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
    <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>
    <script type="text/javascript" src="/js/custom/admin/folders/folderStructure.js" ></script>
    <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/editFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/addFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/deleteFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/copyFolder.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/copyDocument.js"></script>
    <script type="text/javascript" src="/js/custom/admin/documents/editDocument.js"></script>
    <script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
    <script type="text/javascript" src="/js/custom/datetimepicker.js"></script>


        <script type="text/javascript">


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {

                $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});

                var defaultFolderId = $("input[name='default_folder']").val();

                if (defaultFolderId) {
                    var folder = $("#"+defaultFolderId);
                    $("#"+defaultFolderId).parent().click();
                    $.ajax({
                        url : '/admin/document',
                        data : {
                            folder : defaultFolderId,
                            isWeekFolder : folder.attr("data-isweek")
                        }
                    })
                    .done(function(data){
                        console.log(data);
                        fillTable(data);
                    });
                }

            });
        </script>

        @include('site.includes.modal')
        @include('admin.folder.foldermodal')
        @include('site.includes.bugreport')
    </body>
</html>
