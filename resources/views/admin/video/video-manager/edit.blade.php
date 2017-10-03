<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document')
    @include('admin.includes.head')

  <meta name="csrf-token" content="{!! csrf_token() !!}"/>
  <link rel="stylesheet" href="/css/plugins/select/select2.min.css">
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
      <nav class="navbar-default navbar-static-side" role="navigation">
          <div class="sidebar-collapse">
            @include('admin.includes.sidenav')
          </div>
      </nav>

  <div id="page-wrapper" class="gray-bg" >


    <div class="wrapper wrapper-content  animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <h5>Edit Video Details</h5>

                      <div class="ibox-tools">


                      </div>
                  </div>
                  <div class="ibox-content">

                     <form class="form-horizontal">
                        <input type="hidden" name="videoId" id="videoId" value="{{ $video->id }}">


                        <input type="hidden" name="optGroupSelections" id="optGroupSelections" value="{{$optGroupSelections}}">

                        <div class="form-group"><label class="col-sm-2 control-label"> Title
                            <span class="req">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" id="title" name="title" class="form-control" value="{{ $video->title }}">
                            </div>
                        </div>



                        <div class="form-group">
                          {!! Form::label('description', 'Description' , ['class'=>'col-sm-2 control-label']) !!}
                          <div class="col-sm-10">
                              {!! Form::text('description',$video->description, ['class'=>'form-control']) !!}
                          </div>
                        </div>

                        @include('admin.includes.the-ultimate-store-selector')
                        {{--
                        <div class="form-group">
                            {!! Form::label('targets', 'Select Stores', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                <select name="targets[]" id="targets" multiple class="chosen">
                                    <option value="">Select Some Options</option>
                                    @foreach($optGroupOptions as $optionGroups)
                                        <optgroup label="{{$optionGroups['optgroup-label']}}">
                                        @foreach($optionGroups["options"] as $key=>$value)
                                            <option value={{$key}}

                                                @forelse($value['data-attributes'] as $attr=>$val )
                                                    data-{{$attr}} = {{$val}}
                                                @empty
                                                @endforelse

                                            >
                                                {{$value['option-label']}}
                                            </option>
                                        @endforeach
                                        </optgroup>
                                    @endforeach

                                </select>

                            </div>


                        </div> --}}

                        <div class="form-group">
                            <div class="col-sm-1 col-sm-offset-1">
                              @if( $video->featured )
                                <input type="checkbox" id="featured" name="featured" value=1 checked style="margin: 10px 40px 0px;">
                              @else
                                <input type="checkbox" id="featured" name="featured" value=1 style="margin: 10px 40px 0px;">
                              @endif

                            </div>
                            <label class="col-sm-10 control-label" style="text-align:left"> This is a featured video for:</label>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                {!! Form::select('featuredOn', $banners, $video->featuredOn, ['class'=>'chosen-select', 'multiple'=>'multiple' , 'id'=>'featuredOn'])  !!}

                            </div>
                        </div>

                        <div id="tag-selector-container">
                        @include('admin.video.tag.tag-partial', ['tags'=>$tags, 'selected_tags'=>$video->tags])
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

        @include('admin.includes.footer')

          @include('admin.includes.scripts')

        <script type="text/javascript">
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

        </script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
        <script type="text/javascript" src="/js/plugins/select/select2.min.js"></script>
        <script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>
        <script type="text/javascript" src="/js/custom/admin/videos/editVideo.js"></script>

        <script type="text/javascript">
            $(".chosen").chosen({
              width:'75%'
            });

        </script>


        @include('site.includes.bugreport')



      </body>
      </html>
