<!DOCTYPE html>
<html>

<head>
    @section('title', 'Batch File Upload')
    @include('admin.includes.head')

    <link rel="stylesheet" type="text/css" href="/css/vendor/dz.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/dropzone.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/document-upload.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">

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
                    <h2>Batch File Upload</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Batch File Upload</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">


                <div class="col-lg-12 animated fadeInRight">


                <div class="ibox">


                <div class="ibox-content form-group form-horizontal">

                    <div class="form-container">

                        <select name="directory" id="directory">
                            <option value="files">Files</option>
                            <option value="videos">Videos</option>
                            <option value="thumbnails">Video Thumnails</option>
                        </select>



                	       <div id="file-uploader" class="visible">

					       <div id="watermark"><h1 style="color: #fbfbfb; font-size: 200px; position: relative; bottom: 140px;"><i class="fa fa-upload" aria-hidden="true"></i></h1></div>
                           </div>
                    </div>
                    <div class="container" id="container">


					    <div class="table table-striped" id="previews" style="width: 85%;">

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
                                <span>Add files...</span>
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


				</div>


                </div> <!-- end ibox content -->
                </div> <!-- end ibox -->


			</div>


		</div>

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

        <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
        <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
        <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
        <script type="text/javascript" src="/js/custom/admin/documents/batchUploadDocument.js"></script>


		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

            $(document).ready(function() {

                var directory = $("select[name='directory']").val();

                  $.ajax({
                        url : '/admin/document',
                        data : {
                              dir : directory
                        }
                  })
                  .done(function(data){
                        console.log(data);
                  });
            });


		</script>


		@include('site.includes.bugreport')

	</body>
</html>
