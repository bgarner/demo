<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload New Documents')
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

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('admin.includes.topbar')
        </div>

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Upload documents to <span id="folder-name-for-upload">Folder Name</span></h2>
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

                <div class="ibox">
                  <div class="ibox-title">
                    <h5>Optionally edit document Title and/or Start/End</h5>
                  </div>

                  <div class="ibox-content">
          
                    <input type="hidden" name="banner_id" value="{{$banner->id}}">
                    <input type="hidden" name="fo_id" value="{{$banner->id}}">
                    <input type="hidden" name="folder_id" value="{{ $_REQUEST['parent'] }}">

                     <table class="table table-hover issue-tracker">

                          <tbody>

                          <tr>
                            <td>File Name</td>
                            <td>Title</td>
                            <td>Start &amp; End</td>
                          </tr>
                      
                  	@foreach($documents as $doc)
                  		
                  			<tr>
                  			<form id="metadataform{{ $doc->id }}">
                  				
                          <input type="hidden" name="file_id" value="{{ $doc->id }}">

                              <td>{{ $doc->original_filename }}</td>
                              <td><input type="text" style="width: 500px;" class="form-control" name="title{{ $doc->id }}" id="title{{ $doc->id }}" value="{{$doc->title}}"></td>
                		      
                              <td>
                                
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control datetimepicker-start" name="start" id="start{{$doc->id}}" value="{{$doc->start}}" />
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control datetimepicker-end" name="end" id="end{{$doc->id}}" value="{{$doc->end}}" />
                                </div>
                              
                              </td>
                              <button type="submit" class="meta-data-add btn btn-success hidden" data-id="{{ $doc->id }}">Update</button>

                            
          
                  			</form>

                        </tr>
                  	@endforeach
                        </tbody>
                    </table>

                  <div class="row">
                      <div class="form-group">
                          <div class="ibox-tools">
                     
                             <button type="submit" class="meta-data-done btn btn-success" style="margin-right: 24px;"><i class="fa fa-check"></i> Done</button>
                        
                          </div>
                      </div>
                      {{-- <div class="col-md-1">
                                            <br>
                                            <button type="submit" class="meta-data-add-all btn btn-success">Update All</button>
                                            <span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
                                          </div> --}}
                  </div>

                  </div>
                  </div>
      </div>
    </div>

</div>
</div>

                @include('site.includes.footer')
                

                @include('admin.includes.scripts')


            <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
            <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
            <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
            <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
            <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
            <script type="text/javascript" src="/js/custom/tree.js"></script>
            <script type="text/javascript" src="/js/custom/submitmetadata.js"></script>
            <script src="/js/custom/datetimepicker.js"></script>
        
                <script type="text/javascript">


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(document).ready(function() {

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


                        var defaultFolderId = getParameterByName('parent');
                        console.log("defautl folder id: " + defaultFolderId);
                        

                    }); 

                    function getParameterByName(name) {
                        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                            results = regex.exec(location.search);
                        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
                    }
                </script>

                @include('site.includes.bugreport')
            </body>
</html>