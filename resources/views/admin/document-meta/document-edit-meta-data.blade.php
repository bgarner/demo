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
                    <h2>Edit Document</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/document/manager">Document Manager</a>
                        </li>
                        <li>
                            Edit
                        </li>
                        <li class="active">
                            <strong>{{$document->title}}</strong>
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
                      <h5>Document details</h5>

                      <div class="ibox-tools">

                          
                      </div>
                  </div>
                  <div class="ibox-content">
                     <form method="get" class="form-horizontal" >
                              <input type="hidden" name="documentID" id="documentID" value="{{ $document->id }}">
                              <input type="hidden" name="banner_id" value="{{$banner->id}}">

                              <div class="form-group"><label class="col-sm-2 control-label"> Title <span class="req">*</span></label>
                                  <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $document->title }}"></div>
                              </div>

                              
                            {{--
                              <div class="form-group">
                                  {!! Form::label('description', 'Description' , ['class'=>'col-sm-2 control-label']) !!}
                                  <div class="col-sm-10">
                                      {!! Form::text('description',$document->description, ['class'=>'form-control']) !!}      
                                  </div>
                              </div> --}}

                              {{-- <div class="form-group">
                                {!! Form::label('tags[]', 'Tags') !!}
                                {!! Form::select('tags[]', $tags, $selected_tags, ['class'=>'chosen', 'multiple'=>'true']) !!}
                              </div> --}}
                              
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
                                    @if($all_stores)
                                        {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                        {!! Form::label('allStores', 'Or select all stores:') !!}
                                        {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
                                      @else
                                        {!! Form::select('stores', $storeList, $target_stores, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                        {!! Form::label('allStores', 'Or select all stores:') !!}
                                        {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
                                      @endif
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
                              
                              

                              {{--
                              <div class="hr-line-dashed"></div>

                               <div class="form-group">
                                                            
                                      <label class="col-sm-2 control-label">Start &amp; End</label>

                                      <div class="col-sm-10">
                                          <div class="input-daterange input-group" id="datepicker">
                                              @if(isset($alert_details->alert_start))
                                              <input type="text" class="input-sm form-control" name="start" id="start" value="{{$alert_details->alert_start}}" />
                                              <span class="input-group-addon">to</span>
                                              <input type="text" class="input-sm form-control" name="end" id="end" value="{{$alert_details->alert_end}}" />
                                              @else
                                              <input type="text" class="input-sm form-control" name="start" id="start" value="{{$document->start}}" />
                                              <span class="input-group-addon">to</span>
                                              <input type="text" class="input-sm form-control" name="end" id="end" value="{{$document->end}}" />
                                              @endif
                                          </div>
                                      </div>
                              </div> --}}
                              <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/alert"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="alert-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Save changes</span></button>

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

          <script src="/js/custom/datetimepicker.js"></script>
          
        <script type="text/javascript">
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

        </script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>  
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
        <script type="text/javascript" src="/js/custom/admin/alerts/createAlert.js"></script>
        <script type="text/javascript" src="/js/custom/admin/global/storeSelector.js"></script>
        @include('site.includes.bugreport')



      </body>
      </html>
