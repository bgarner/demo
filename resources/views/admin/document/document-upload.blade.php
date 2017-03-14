<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload New Documents')
    @include('admin.includes.head')

  {{-- <link href="/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
  {{-- <link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css"> --}}
  <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/dz.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/dropzone.css">
  <link rel="stylesheet" type="text/css" href="/css/custom/document-upload.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">
  <link rel="stylesheet" type="text/css" href="/css/custom/package.css">    

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
                    <h2>Upload New Documents</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Documents</a>
                        </li>
                        <li class="active">
                            <strong>Upload</strong>
                        </li>
                    </ol>
                </div>

    </div>


<div class="wrapper wrapper-content animated fadeInRight">


                            <div class="row">
                              <div id="folder-title" data-folderId= "" data-isWeekFolder = "">
                                <h2></h2>
                              </div>
                              <table class="table tablesorter" id="file-table"> 
                              </table>

                            </div>

                                    <div class="container" id="container">
                                       <div id="actions" class="row">

                                        {!! csrf_field() !!}
                                        <input type="hidden" name="upload_package_id"  id="upload_package_id" value="{{ $packageHash }}" />
                                        <input type="hidden" name="folder_id" value="3" />



                                          <div class="col-lg-5">
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process">
                                              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                              </div>
                                            </span>
                                          </div>

                                        </div>

                                        <div class="table table-striped" id="previews">

                                            <div id="template" class="file-row">
                                            <!-- This is used as the file preview template -->
                                                <div>
                                                    <span class="preview"><img data-dz-thumbnail /></span>
                                                </div>

                                                <div>
                                                    <p class="name" data-dz-name></p>
                                    {{--                 <input type="text" name="title[]" />
                                                    <input type="text" name="description[]" /> --}}
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>

                                                <div>
                                                    <p class="size" data-dz-size></p>
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                    </div>
                                                </div>

                                                <div>
                                                  <button class="btn btn-primary start">
                                                      <i class="glyphicon glyphicon-upload"></i>
                                                      <span>Start</span>
                                                  </button>
                                                  <button data-dz-remove class="btn btn-warning cancel">
                                                      <i class="glyphicon glyphicon-ban-circle"></i>
                                                      <span>Cancel</span>
                                                  </button>
                                                  <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Remove</span>
                                                  </button>
                                                </div>
                                          </div>

                                        </div>
                                    </div>

            </div>

        @include('site.includes.footer')
        @include('admin.includes.scripts')

      <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
      <script type="text/javascript" src="/js/custom/tree.js"></script>
      <script type="text/javascript" src="/js/custom/admin/folders/folderStructure.js" ></script>
      <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
      <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
      <script type="text/javascript" src="/js/custom/admin/documents/getPackages.js"></script>
      <script type="text/javascript" src="/js/custom/admin/documents/deletePackage.js"></script>
      <script type="text/javascript" src="/js/custom/admin/documents/showPackage.js"></script>
      <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
<!--       <script type="text/javascript" src="/js/vendor/dropzone.js"></script> -->
      <script type="text/javascript" src="/js/custom/admin/documents/uploadDocument.js"></script>
      <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
      <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>        
      
        <script type="text/javascript">
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

        $(document).ready(function() {

            $(".dropdown-toggle").dropdown();
            $(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});
            
            var defaultFolderId = $("input[name='default_folder']").val();
            if (defaultFolderId) {
              var folder = $("#"+defaultFolderId);
              $("#"+defaultFolderId).parent().click();
              $.ajax(
              {
                url : '/admin/document',
                data : {
                      folder : defaultFolderId,
                      isWeekFolder : folder.attr("data-isweek")
                     }
              }
              )
              .done(function(data){
                console.log(data);
                fillTable(data);
              });

            }

            
//            $( ".navigation-container" ).resizable();

                 
        });            

        </script>

        
        @include('site.includes.bugreport')


      </body>
      </html>

