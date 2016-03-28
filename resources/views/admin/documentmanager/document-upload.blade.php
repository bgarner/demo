<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload New Documents')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <style type="text/css">
    .upload-form{ display: none;  }
    </style>
</head>

<body class="fixed-navigation adminview" onload="checkDeepLink()">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('admin.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('admin.includes.topbar')
        </div>

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Upload Files <span id="folder-name-for-upload"></span></h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/document">Documents</a></li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">


                <div class="col-lg-12 animated fadeInRight">


                <center>
                    <span class="btn btn-success btn-lg btn-outline all-stores">All Stores</span>
                    <span class="btn btn-success btn-lg btn-outline select-stores">Selected Stores</span>
                </center>

                <div >
                    <div class="form-group upload-form select-stores-form">                                    
                    <label class="col-sm-2 control-label">Target Stores</label>
                    <div class="col-sm-10">
                        {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                        {!! Form::label('allStores', 'Or select all stores:', ['class'=>'hidden']) !!}
                        {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores', 'class'=>'hidden'] ) !!}
                    </div>

                    </div>
                </div>

                <div class="form-group">

                        <label class="col-sm-2 control-label">Start &amp; End</label>

                        <div class="col-sm-10">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" name="send_at" id="send_at" value="" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="archive_at" id="archive_at" value="" />
                            </div>
                        </div>
                </div>


                <div  class="all-stores-form upload-form">
                this is teh form for all the stores
                </div>



                	<div id="file-uploader" class="visible">

					<div id="watermark">Drag and drop documents here</div>

         <div class="container" id="container">
					   <div id="actions" class="row">
					    {!! csrf_field() !!}
					    <input type="hidden" name="upload_package_id"  id="upload_package_id" value="{{ $packageHash }}" />
					    <input type="hidden" id="folder_id" name="folder_id" value="" />



					      <div class="col-lg-7 file-actions">


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



				</div>

          
			</div>


		</div>

                    

	</div>
</div>



{{-- 
            @include('site.includes.modal') --}}

                @include('site.includes.footer')
                

                @include('admin.includes.scripts')


            <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
            <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
            <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
            <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>

            <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>

            <script type="text/javascript" src="/js/custom/admin/folders/documentUploadFolderStructure.js" ></script>
            <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/getPackages.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deletePackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/showPackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/uploadDocument.js"></script>
            <script type="text/javascript" src="/js/custom/tree.js"></script>
            <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

        
                <script type="text/javascript">


                    $('.input-daterange').datepicker({
                         format: 'yyyy-mm-dd',
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true
                    });  
                    

                   

                    
                                       
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(document).ready(function() {

                        $(".chosen").chosen({ width:'75%' });

                        $( ".select-stores" ).click(function() {
                            console.log('select store clicked');
                            $(this).removeClass('btn-outline');
                            $(".all-stores").addClass('btn-outline');
                            $('.select-stores-form').show();
                            
                            $(".all-stores-form").hide();
                            // $('.select-stores-form').toggleClass('visible');
                        });

                        $( ".all-stores" ).click(function() {
                            $(this).removeClass('btn-outline');
                            $(".select-stores").addClass('btn-outline');

                            $('.all-stores-form').show();
                            $('.select-stores-form').hide();
                             $("#allStores").prop('checked', 'true');
                             $("#allStores").click();
                             console.log($("#storeSelect").val());
                        });

                        $("#allStores").change(function(){

                            if ($("#allStores").is(":checked")) {

                                $("#storeSelect option").each(function(index){            
                                    $(this).attr('selected', 'selected');
                                });
                                $("#storeSelect").chosen();
                                
                            }
                            else if ($("#allStores").not(":checked")) {
                                $("#storeSelect option").each(function(){
                                    $(this).removeAttr('selected');
                                });
                                $("#storeSelect").chosen();
                                
                            }

                            console.log($("#storeSelect").val());
                        }); 


                        var form = $("#example-advanced-form").show();
                         
                        form.steps({
                            headerTag: "h3",
                            bodyTag: "fieldset",
                            transitionEffect: "slideLeft",
                            onStepChanging: function (event, currentIndex, newIndex)
                            {
                                // Allways allow previous action even if the current form is not valid!
                                if (currentIndex > newIndex)
                                {
                                    return true;
                                }
                                // Forbid next action on "Warning" step if the user is to young
                                if (newIndex === 3 && Number($("#age-2").val()) < 18)
                                {
                                    return false;
                                }
                                // Needed in some cases if the user went back (clean up)
                                if (currentIndex < newIndex)
                                {
                                    // To remove error styles
                                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                                }
                                form.validate().settings.ignore = ":disabled,:hidden";
                                return form.valid();
                            },
                            onStepChanged: function (event, currentIndex, priorIndex)
                            {
                                // Used to skip the "Warning" step if the user is old enough.
                                if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                                {
                                    form.steps("next");
                                }
                                // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                                if (currentIndex === 2 && priorIndex === 3)
                                {
                                    form.steps("previous");
                                }
                            },
                            onFinishing: function (event, currentIndex)
                            {
                                form.validate().settings.ignore = ":disabled";
                                return form.valid();
                            },
                            onFinished: function (event, currentIndex)
                            {
                                alert("Submitted!");
                            }
                        // }).validate({
                        //     errorPlacement: function errorPlacement(error, element) { element.before(error); },
                        //     rules: {
                        //         confirm: {
                        //             equalTo: "#password-2"
                        //         }
                        //     }
                        });



                        
                        // $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});

                        // var defaultFolderId = $("input[name='default_folder']").val();

                        // if (defaultFolderId) {
                        //     var folder = $("#"+defaultFolderId);
                        //     $("#"+defaultFolderId).parent().click();
                        //     $.ajax({
                        //         url : '/admin/document',
                        //         data : {
                        //             folder : defaultFolderId,
                        //             isWeekFolder : folder.attr("data-isweek")
                        //         }
                        //     })
                        //     .done(function(data){
                        //         console.log(data);
                        //         fillTable(data);
                        //     });
                        // }

                    }); 
                </script>

                @include('site.includes.bugreport')
            </body>
</html>