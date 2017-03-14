<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document')
    @include('admin.includes.head')

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
                    <h2>Edit Video</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/video">Video</a>
                        </li>
                        <li>
                            Edit
                        </li>
                        <li class="active">
                            <strong>{{$video->title}}</strong>
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
                      <h5>Video details</h5>

                      <div class="ibox-tools">

                          
                      </div>
                  </div>
                  <div class="ibox-content">
                     
                     <form class="form-horizontal">
                              <input type="hidden" name="videoId" id="videoId" value="{{ $video->id }}">
                              <input type="hidden" name="banner_id" value="{{$banner->id}}">

                              <div class="form-group"><label class="col-sm-2 control-label"> Title <span class="req">*</span></label>
                                  <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $video->title }}"></div>
                              </div>

                              
                            
                              <div class="form-group">
                                  {!! Form::label('description', 'Description' , ['class'=>'col-sm-2 control-label']) !!}
                                  <div class="col-sm-10">
                                      {!! Form::text('description',$video->description, ['class'=>'form-control']) !!}      
                                  </div>
                              </div>

                            <div class="form-group">
                                {!! Form::label('tags[]', 'Tags', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::select('tags[]', $tags, $selected_tags, ['class'=>'chosen', 'multiple'=>'true', 'id'=>'tagsSelected']) !!}
                                </div>
                            </div>
                              

     
                              
                              <div class="form-group">
                                <label class="col-sm-2 control-label"> This is a featured video</label>
                                <div class="col-sm-1">
                                  @if( $video->featured )
                                    <input type="checkbox" id="featured" name="featured" value=1 checked>
                                  @else
                                    <input type="checkbox" id="featured" name="featured" value=1>
                                  @endif
                                    
                                </div>
                              </div>
                              

                              <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/video"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="video-update btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Save changes</span></button>

                                </div>
                              </div>
                      </form>
                  </div><!-- ibox content closes -->
                     

              </div> <!-- ibox closes -->



          </div>
      </div>


  </div>

        @include('site.includes.footer')

          @include('admin.includes.scripts')
          
        <script type="text/javascript">
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

        </script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script> 
        <script type="text/javascript" src="/js/custom/admin/videos/editVideo.js"></script> 
        <script type="text/javascript">
            $(".chosen").chosen({
              width:'75%'
            });
            // $('.input-daterange').datepicker({
            //     format: 'yyyy-mm-dd',
            //     keyboardNavigation: false,
            //     forceParse: false,
            //     autoclose: true
            // });             

        </script>
        
        @include('site.includes.bugreport')



      </body>
      </html>
