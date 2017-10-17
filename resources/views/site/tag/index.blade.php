<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tag: ' . $tagname)
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>

    #footer{
        position: fixed;
        bottom: 0px;
    }

    </style>

</head>

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg clearfix">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="row">
                <div class="col-lg-8">
                <h2>{{__("Items tagged")}}: <span class="search-query label">{{ $tagname }}</span></h2>
                </div>
               <div class="col-lg-2 col-lg-offset-2" >
                    <form class="form-inline" >
                        <div tyle="float:right">
                            <label>{{__("Archives")}}</label>

                                <div class="switch">
                                    <div class="onoffswitch">

                                        @if(isset($archives))
                                        <input type="checkbox" checked="" class="onoffswitch-checkbox" id="archives" name="archives">
                                        @else
                                        <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                        @endif
                                        <label class="archive-onoffswitch onoffswitch-label" for="archives">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>

                        </div>
                    </form>
                </div>
<!--                 <ol class="breadcrumb">
                    <li>jdaf ja fl aslk salk adslkd aslkdsa lksad</li>
                </ol> -->
            </div>

        </div>



            <div class="wrapper wrapper-content">

                <div class="row">


                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>{{__("Documents")}} <small>{{ count($docs) }} results</small></h2>
                        </div>

                        @if( count($docs) > 0)
                        <div class="mail-box">

                            <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                <thead>
                                    <tr>
                                        <th>{{__("Title")}}</th>
                                        <th>{{__("Folder")}}</th>
                                        <th>{{__("Last Updated")}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($docs as $doc)
                                    @if($doc->archived)
                                        <tr class="archived">
                                    @else
                                        <tr>
                                    @endif
                                        <td class="mail-subject">{!! $doc->modalLink !!}</td>
                                        <td><a href="/{{ Request::segment(1) }}/document#!/{{ $doc->folder->global_folder_id}}">{{ $doc->folder->name }}</a></td>
                                        <td>{{ $doc->since }} {{__("ago")}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>








                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>{{__("Communications")}} <small>{{ count($communications) }} {{__("results")}}</small></h2>
                        </div>
                        @if( count($communications) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{__("Subject")}}</th>
                                        <th>  </th>
                                        <th>{{__("Posted")}}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($communications as $comm)
                                    @if($comm->archived)
                                        <tr class="archived">
                                    @else
                                        <tr>
                                    @endif
                                        <td class="check-mail"><i class="fa fa-envelope-o"></i></td>
                                        <td class="mail-subject"><a href="/{{ Request::segment(1) }}/communication/show/{{ $comm->id }}">{{ $comm->subject }}</a></td>
                                        <td>{!! $comm->trunc !!}</td>
                                        <td>{{ $comm->since }} {{__("ago")}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>{{__("Playlists")}} <small>{{ count($videos) }} {{__("results")}}</small></h2>
                        </div>
                        @if( count($videos) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> {{__("Title")}} </th>
                                        <th> {{__("Thumbnail")}} </th>
                                        <th> {{__("Description")}} </th>
                                        <th> {{__("Last Updated")}} </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($playlists as $p)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-film"></i></td>

                                        <td>{{ $p->title }}</td>
                                        <td><a href="/{{ Request::segment(1) }}/video/playlist/{{$p->id}}"> <img src="/video/thumbs/{!! $p->thumbnail !!}"  height="75" width="125"></a></td>
                                        <td>{!! $p->description !!} </td>
                                        <td>{{ $p->since }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>{{__("Videos")}} <small>{{ count($videos) }} {{__("results")}}</small></h2>
                        </div>
                        @if( count($videos) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> {{__("Title")}} </th>
                                        <th> {{__("Thumbnail")}} </th>
                                        <th> {{__("Description")}} </th>
                                        <th> {{__("Last Updated")}} </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($videos as $v)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-film"></i></td>

                                        <td>{{ $v->title }}</td>
                                        <td><a href="/{{ Request::segment(1) }}/video/watch/{{$v->id}}"> <img src="/video/thumbs/{!! $v->thumbnail !!}"  height="75" width="125"></a></td>
                                        <td>{{ $v->description }} </td>
                                        <td>{{ $v->since }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>





                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')
    @include('site.includes.bugreport')
    @include('site.includes.modal')
    <script type="text/javascript" src="/js/custom/site/getArchivedContent.js"></script>
    <script type="text/javascript" src="/js/custom/site/highlightSearch.js"></script>

    <script>
        // $(".datatable").dataTable({
        //     "bPaginate": false,
        //     "order": [],
        //     "info":     false,
        //     "searching": false,
        //     "columns": [
        //        {"orderable": false,},null, null,null
        //      ],
        // });
    </script>


</body>
</html>
