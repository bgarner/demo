<!DOCTYPE html>
<html>

<head>
    @section('title', 'Latest Videos')

    @include('site.includes.head')

    <style>
    #page-wrapper{
    {{-- background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/featured-backgrounds/{{ $feature->background_image }}') no-repeat 0px 50px; --}}
        background-size: cover;
        overflow: hidden;
    }

    #footer{
        position: fixed;
        bottom: 0px;
    }

    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }

    #file-table tr td:last-child {
        white-space: nowrap;
        width: 1%
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
                <h1>Playlists</h1>
            </div>


            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content clearfix">
                                @foreach($playlists as $pl)
                                    <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <a href="playlist/{{$pl->id}}" class="trackclick" data-video-id="{{$pl->id}}"><img src="/video/thumbs/{{$pl->thumbnail}}" class="embed-responsive-item img-responsive" /></a>
                                        </div>
                                        <a href="playlist/{{$pl->id}}" class="trackclick" data-video-id="{{$pl->id}}"><h4>{{$pl->title}}</h4></a>
                                        <p>{{$pl->count}} videos &middot; {{$pl->sinceCreated}} ago</p>
                                    </div>
                                @endforeach
                            </div>

                            <center>
                            {!! $playlists->render() !!}
                            </center>

                        </div>
                    </div>
            </div>


                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>

    @include('site.includes.modal')

</body>
</html>
