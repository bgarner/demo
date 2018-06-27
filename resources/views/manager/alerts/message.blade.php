<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('manager.includes.head')

</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('manager.includes.nav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('manager.includes.topbar')
        </div>

        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

                @include('manager.communications.commsidebar')

                </div>


                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 animated fadeInRight printable">

                <div class="mail-box-header">

                    <h2>
                        {{ $communication->subject }}
                         <span class="pull-right font-normal" style="font-size: 16px;">{{ $communication->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} {{__("ago")}})</small></span>
                    </h2>


                    @if(isset($communication->previousCommunicationId))

                    <span class="pull-left">
                        <a href="/{{ Request::segment(1) }}/communication/show/{{$communication->previousCommunicationId}}"><i class="fa fa-angle-double-left"></i> {{__("Previous")}}</a>
                    </span>
                    @endif
                    @if(isset($communication->nextCommunicationId))
                    <span class="pull-right">
                        <a href="/{{ Request::segment(1) }}/communication/show/{{$communication->nextCommunicationId}}">{{__("Next")}} <i class="fa fa-angle-double-right"></i></a>
                    </span>

                    @endif

                </div> <!-- mail-box-header closes -->
                    <div class="mail-box">


                        <div class="mail-body">
                            {!! $communication->body !!}
                        </div> <!-- mail-body closes -->

                        <div class="mail-attachment">
                            <h3>
                                <span><i class="fa fa-paperclip"></i> {{ count($communication_documents) }} {{__("Attachments")}}</span>
                            </h3>

                            @if(count($communication_documents) > 0)
                                <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                    <thead>
                                        <tr>
                                            <th> {{__("Title")}} </th>
                                            <th> {{__("Last Updated")}} </th>
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

                            @if(count($tags) > 0)
                            <hr />
                            <div class="tag-list">
                                @foreach($tags as $t)
                                    <a href="../../tag/{{ $t->linkname }}"><span class="badge">{{ $t->name }}</span></a>
                                @endforeach
                            </div>
                            @endif


                            <div class="clearfix"></div>
                        </div> <!-- mail-attachment closes -->

                    </div> <!-- mail-box closes -->



                </div> <!-- printable div closes -->

            </div> <!-- row closes -->
        </div> <!-- class wrapper closes -->

    </div> <!-- page wrapper closes -->
    </div> <!-- wrapper closes -->

    @include('manager.includes.footer')

    @include('manager.includes.scripts')
    

    <script type="text/javascript" src="/js/custom/tree.js"></script>
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
            $(".inline-communication-link").click(function(){
                var communicationId = $(this).data('communicationid');
                var storeNumber = localStorage.getItem('userStoreNumber');
                window.location = "/"+storeNumber+"/communication/show/"+communicationId;
            });
        });


    </script>

    @include('site.includes.modal')

</body>
</html>
