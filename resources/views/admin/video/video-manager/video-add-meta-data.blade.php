<!DOCTYPE html>
<html>

<head>
    @section('title', 'Upload New Documents')
    @include('admin.includes.head')
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/css/plugins/chose/chosen.css">
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
                <h2>Upload videos </h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin/video">Videos</a></li>
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
                    <h5>Add video data</h5>
                  </div>

                  <div class="ibox-content">
          
                    <input type="hidden" name="banner_id" value="{{$banner->id}}">
                    <input type="hidden" name="fo_id" value="{{$banner->id}}">

                     <table class="table table-hover issue-tracker">

                          <tbody>

                         <!--  <tr>
                            <td>File Name</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Tags</td>
                          </tr> -->
                      
                  	@foreach($videos as $vid)
                  		<tr> <h4> Add data for <i> {{ $vid->original_filename }} </i></h4> </tr>
                  		<tr>
                  			<form id="metadataform{{ $vid->id }}">
                  				      

                                <input type="hidden" name="video_id" value="{{ $vid->id }}">

                                <div class="row">
                                  <label class="col-md-2"> Title </label>
                                  <div class="col-md-10">
                                  <input type="text" class="form-control" name="title{{ $vid->id }}" id="title{{ $vid->id }}" value="{{$vid->title}}">
                                  </div>
                                </div>
                    		        <div class="row">
                                  <label class="col-md-2">Description</label>
                                  <div class="col-md-10">
                                  <input type="text" class="form-control" name="description{{ $vid->id }}" id="description{{ $vid->id }}" value="{{$vid->description}}">
                                  </div>
                                </div>

                                <div class="row"> 
                                  <label class="col-md-2"> Tags</label>             
                                  <div class="col-md-10">
                                      {!! Form::select('tags[]', $tags, null, ['class'=>'chosen' , 'multiple'=>'true', 'id'=>"select$vid->id"]) !!}
                                  </div>
                                </div>
                                <button type="submit" class="meta-data-add btn btn-success hidden" data-id="{{ $vid->id }}">Update</button>
          
                  			</form>

                        </tr>
                        <div class="hr-line-dashed"></div>
                  	@endforeach
                        </tbody>
                    </table>

                  <div class="row">
                      <div class="form-group">
                          <div class="ibox-tools">
                     
                             <button type="submit" class="meta-data-done btn btn-success" style="margin-right: 24px;"><i class="fa fa-check"></i> Done</button>
                        
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


            <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
            <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
            <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
            <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
            <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
            <script type="text/javascript" src="/js/custom/tree.js"></script>
            <script type="text/javascript" src="/js/custom/admin/videos/submitmetadata.js"></script>
            <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
        
                <script type="text/javascript">


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(".chosen").chosen({
                      'width':'100%'
                    });

                </script>

                @include('site.includes.bugreport')
            </body>
</html>