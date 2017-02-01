<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload Product Launch Document')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/vendor/dz.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/dropzone.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/document-upload.css">
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
                    <h2>Product Launch</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <a href="/admin/communication">Product Launch</a>
                        </li>
                        <li class="active">
                            <strong>Upload Document</strong>
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
                                    <h5>Upload Product Launch Document</h5>

                                    <div class="ibox-tools">
                                        <select name="uploadOptionProductLaunch" id="uploadOptionProductLaunch">
                                            <option value="">Select Option</option>
                                            <option value="append">Append to Product Launches</option>
                                            <option value="clear">Clear Old Product Launches</option>
                                            <!-- <option value="patch">Upload Patch</option> -->

                                        </select>

                                        <!-- <input type="radio" id="appendProductLaunch" name="uploadOptionProductLaunch" value="append"> <label for="appendProductLaunch">Append to Product Launches </label>
                                        <input type="radio" id="clearProductLaunch" name="uploadOptionProductLaunch" value="clear"> <label for="">Clear Old Product Launches </label> -->
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    
                                    <div class="ibox-content form-group form-horizontal">

                                        <div id="file-uploader" class="visible">

                                        <div id="watermark"><h1>Drag and drop files here</h1></div>

                                        <div class="container" id="container">


                                            <div class="table table-striped" id="previews">

                                                <div id="template" class="file-row">
                                                <!-- This is used as the file preview template -->
                                                    <div>
                                                        <span class="preview"><img data-dz-thumbnail /></span>
                                                    </div>

                                                    <div>
                                                        <p style="display: inline;"class="name" data-dz-name></p> ( <p style="display: inline;" class="size" data-dz-size></p> )
                                                        
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>

                                                    <div>
                                                          
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 200px;">
                                                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                      <button class="btn btn-xs btn-primary start">
                                                          <i class="glyphicon glyphicon-upload"></i>
                                                          <span>Start</span>
                                                      </button>
                                                      <button data-dz-remove class="btn btn-xs btn-warning cancel">
                                                          <i class="glyphicon glyphicon-ban-circle"></i>
                                                          <span>Cancel</span>
                                                      </button>
                                                      <button data-dz-remove class="btn btn-xs btn-danger delete">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                        <span>Remove</span>
                                                      </button>
                                                    </div>
                                              </div>

                                            </div>
                                        </div>


                                        </div>


                                           <div id="actions" class="row">
                                            {!! csrf_field() !!}
                                            
                                            <input type="hidden" id="banner_id" name="banner_id" value="{{$banner->id}}" />


                                              <div class="col-lg-6">
                                                <!-- The global file processing state -->
                                                <span class="fileupload-process">
                                                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                                    <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                                                  </div>
                                                </span>
                                              </div>

                                              <div class="col-lg-6 file-actions">


                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn btn-success fileinput-button dz-clickable">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Add documents...</span>
                                                </span>
                                                <button type="submit" class="btn btn-primary start disabled">
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>Start upload</span>
                                                </button>
                                                <button type="reset" class="btn btn-warning cancel disabled">
                                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                                    <span>Cancel upload</span>
                                                </button>
                                              </div>                          

                                            </div>

                              
                                    </div> <!-- end ibox content -->
                                </div> <!-- ibox-content closes -->

                            </div><!-- ibox closes -->
                        </div>
                    </div>


                </div><!-- wrapper closes -->



        @include('site.includes.footer')

        @include('admin.includes.scripts')

        @include('site.includes.bugreport')
        
        <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
        <script type="text/javascript" src="/js/custom/admin/productlaunch/uploadDocument.js"></script>
        
        <script type="text/javascript">

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        </script>

    </body>
    </html>
