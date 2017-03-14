<!DOCTYPE html>
<html>

<head>
    @section('title', 'Alerts')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    <style>
    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }
    </style>    
</head>	

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
               @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                  @include('site.includes.topbar') 
            </div>


            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">

                        @include('site.alerts.alertssidebar')

                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 animated fadeInRight">
                        <div class="mail-box-header">

                            <div class="row">
                                <div class="col-md-6">
                                    <h2>
                                    	@if($title == "")
                                    		All Alerts 
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


                            <table class="table table-hover table-mail alert-table">
                            
                                <thead>
                                    <tr> 
                                        
                                        <th> Type</th>
                                        <th> Title </th>
                                        <!-- <th> Description </th> -->
                                        <th> Date </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                @foreach($alerts as $alert)
                                

                                @if(isset($alert->archived))
                                <tr class="unread archived">
                                @else
                                <tr class="unread">
                                @endif    
                                    <td class="check-mail col-lg-1 col-md-1 col-sm-2 col-xs-1 ">
                                        <i class="fa fa-bell-o"></i><span class="label">{{ $alert->alertTypeName }}</span>
                                    </td>
                                
                                    <td class="mail-subject col-lg-8 col-md-7 col-sm-3 col-xs-5 ">{!! $alert->link_with_icon !!}</td>
                                    <!-- <td class="mail-preview">{{ $alert->description }}</td> -->
                                    
                                    <td class="mail-date col-lg-3 col-md-4 col-sm-4 col-xs-2">{{ $alert->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $alert->since }} ago)</small> --></td>
                                </tr>                

                                @endforeach
                                 
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('site.includes.footer')       
  
    @include('site.includes.scripts')
    <script type="text/javascript" src="/js/custom/site/getArchivedContent.js"></script>

    <script type="text/javascript">
        $("body").on("click", ".launchPDFViewer", function(e){
            var filepath = $(this).attr("data-file");
            $("#fileviewmodal").find('iframe').attr("src", filepath);
        });
    </script>

    <script type="text/javascript">
        
        $( document ).ready(function() {
            var archiveCheckbox  = $('#archives');
            var checked = archiveCheckbox.is(":checked");
            
            if( checked == true){
                $("a.alert_category_link").each(function() {
                   var href = $(this).attr("href"); 
                   $(this).attr("href", href + '&archives=true');
                });                
            } else {
                $("a.alert_category_link").each(function() {
                   var href = $(this).attr("href"); 
                   $(this).attr('href', href.replace(/&?archives=\d+/, ''));
                });                                 
            }
        });

    </script>

    @include('site.includes.modal')

</body>
</html> 