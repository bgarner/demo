<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    
</head>	

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            @include('site.communications.commsidebar')

            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>
                                @if($title == "")
                                    All Messages {{-- <small>({{ $communicationCount }} unread)</small> --}}
                                @else
                                    {{ $title }}
                                @endif
                            </h2>
                        </div>

                        <div class="col-lg-4 col-lg-offset-2" id="archive-switch">
                            <form class="form-inline" >
                                <div class="pull-right">
                                    
                                    <small style="font-weight: bold; padding-right: 5px;">Show Archive</small>
                                        
                                        <div class="switch pull-right">
                                            <div class="archive-onoffswitch onoffswitch">
                                                
                                                @if($archives)
                                                    <input type="checkbox" checked="" class="onoffswitch-checkbox" id="archives" name="archives">
                                                @else
                                                    <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                                @endif
                                                
                                                <label class="onoffswitch-label" for="archives">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mail-box">


                    <table class="table table-hover table-mail">
                        <tbody>

                        @foreach($communications as $communication)
                        <?php $tr_class="" ?>
                        @if( $communication->is_read == 1)
                            <?php $tr_class = "unread";?>
                        @else
                            <?php $tr_class = "unread"; ?>
                        @endif

                        <?php $icon_class="fa fa-envelope-o" ?>
                        @if($communication->archived)
                            <?php $tr_class .= " archived"; ?>
                        @endif


                        <tr class= "{{ $tr_class }}" >
                            <td class="check-mail">
                                
                                <i class="{{$icon_class}}"></i>
                            </td>

                            @if( $communication->communication_type_id == "1" ||  $communication->communication_type_id == "2" )
                                <td class="mail-subject communication-name">
                                    @if($communication->has_attachments == true)
                                        <i class="fa fa-paperclip"></i>
                                    @endif
                                    <a class="comm_category_link trackclick" data-comm-id="{{ $communication->id }}" href="communication/show/{{ $communication->id }}?">{{ $communication->subject }}</a>
                                </td>
                            @else
                                <td class="mail-subject communication-name col-lg-4 col-md-4 col-sm-4 col-xs-5">
                                    @if($communication->has_attachments == true)
                                        <i class="fa fa-paperclip"></i>
                                    @endif
                                    <a class="comm_category_link trackclick" data-comm-id="{{ $communication->id }}" href="communication/show/{{ $communication->id }}?">{{ $communication->subject }}</a> <span class="label label-sm label-{!! $communication->label_colour !!}">{!! $communication->label_name !!}</span></td>
                            @endif
                            
                            <td class="mail-preview col-lg-5 col-md-4 hidden-sm hidden-xs"><a href="communication/show/{{ $communication->id }}">{!! $communication->trunc !!}</a></td>
                            <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                            <td class="text-right mail-date col-lg-3 col-md-2 col-sm-4 col-xs-2">{{ $communication->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small> --></td>
                        </tr>                

                        @endforeach
                         
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        </div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')
    <script src="/js/custom/site/getArchivedContent.js"></script>
    <script src="/js/plugins/iCheck/icheck.min.js"></script>
 
	<script>
    
        $( document ).ready(function() {
            var archiveCheckbox  = $('#archives');
            var checked = archiveCheckbox.is(":checked");
            
            if( checked == true){
                $("a.comm_category_link").each(function() {
                   var href = $(this).attr("href"); 
                   $(this).attr("href", href + '&archives=true');
                });                
            } else {
                $("a.comm_category_link").each(function() {
                   var href = $(this).attr("href"); 
                   $(this).attr('href', href.replace(/&?archives=\d+/, ''));
                });                                 
            }
        });

    </script>

    @include('site.includes.modal')

</body>
</html> 