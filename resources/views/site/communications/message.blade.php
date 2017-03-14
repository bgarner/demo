<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
    @include('site.includes.head')
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/css/custom/site/feature.css">
</head>	

<body class="fixed-navigation">

    <input type="hidden" id="communication_id" name="communication_id" value="{{ $communication->id }}">
    <input type="hidden" id="store_id" name="store_id" value="{{ Request::segment(1) }}">
    <input type="hidden" id="archives" value="" />

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
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            @include('site.communications.commsidebar')

            </div>

            
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8 animated fadeInRight printable">

            <div class="mail-box-header">

                <h2>
                    {{ $communication->subject }}
                     <span class="pull-right font-normal" style="font-size: 16px;">{{ $communication->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small></span>
                </h2>

            </div>
                <div class="mail-box">


                    <div class="mail-body">
                        {!! $communication->body !!}
                    </div>

                    <div class="mail-attachment">
                    <h3>
                        <span><i class="fa fa-paperclip"></i> {{ count($communication_documents) }} Attachments</span>
                    </h3>

                    @if(count($communication_documents) > 0)
                        <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                            <thead>
                                <tr> 
                                    <th> Title </th> 
                                    <th> Last Updated </th> 
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($communication_documents as $doc)
                                <tr>
                                    <td> {!! $doc->link_with_icon !!} </td>
                                    <td> {!! $doc->prettyDate !!} </td>
                                </tr>

                            @endforeach
                            </tbody>                                                                       
                        </table>
                    @endif

                            {{--<div class="file-box">
                                    <div class="file">
                                        {!! $doc->anchor_only !!}
    
                                            <div class="icon">
                                                {!! $doc->icon !!}
                                            </div>
    
    
                                            <div class="file-name">
                                                <div style="font-size: 16px; padding-bottom: 10px;"> {{ $doc->title }}</div>
                                                
                                                <small class="clearfix"><span class="text-muted pull-left">{{ $doc->prettyDate }}</span> <span class="text-muted pull-right">{{ $doc->since }} ago</span></small>
    
                                            </div>
                                        </a>
                                    
                                    </div>
    
                                </div>    --}}                
                    
                    
                    <div class="clearfix"></div>
                    </div>

                    <!-- <div class="mail-attachment">
                        <h3>
                            <span><i class="fa fa-paperclip"></i> {{ count($communication_packages) }} Packages</span>
                        </h3>
            
                        <div class="row">
                            <div class="col-lg-4 package-listing">
                            {{--@foreach($communication_packages as $package)                                                        
                                    @include('site.feature.package-listing', ['package'=>$package])
                                @endforeach--}}
                            </div>

                            <div class="col-lg-8 package-document-container">


                                {{-- @foreach($communication_packages as $package)
                                    <?php $package_document_listing = $package['details']['package_documents']; ?>
                                    
                                    <div  class="package-document-listing hidden" data-packageid= {{$package->id}} >

                                        @foreach ($package_document_listing as $document)
                                        {!! $document->link_with_icon !!}
                                        
                                           
                                        @endforeach
                                    </div>

                                    <div class="package-folder-document-listing hidden" data-packageid = {{$package->id}}>

                                    </div>

                                @endforeach--}}
                            </div>
                        </div>               
                    
                    <div class="clearfix"></div>
                    </div> -->



            </div>            

                
        
</div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    
    @include('site.includes.scripts')
   
    <script type="text/javascript" src="/js/custom/tree.js"></script>
    <script type="text/javascript" src="/js/custom/site/communications/markAsRead.js"></script>
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/custom/site/features/showFeaturePackageDetails.js"></script>

     <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});


         var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
    
        $( document ).ready(function() {

            var checked = getUrlParameter('archives');
            
            if( checked == 'true'){
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

            $(".inline-folder-link").click(function(){
                var folderId = $(this).data('folderid');
                var storeNumber = localStorage.getItem('userStoreNumber');
                window.location = "/"+storeNumber+"/document#!/"+folderId;
            });
        });

 
    </script>

    @include('site.includes.modal')

</body>
</html> 