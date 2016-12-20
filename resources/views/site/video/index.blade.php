<!DOCTYPE html>
<html>

<head>
    @section('title', 'Video')

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

                {{-- <h1 style="color: #333; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;padding-bottom: 0px; line-height: 50px;">Video Library</h1> --}}
                {{-- <div class="col-lg-10">
                    <h2>Video</h2>
                </div> --}}

                {{-- <div class="col-lg-2">

                </div> --}}

                <h2>Video Library</h2>

            </div>

            <br />
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2>Featured Video</h2>
                        </div>

                        <a href="video/watch/{{$featured->id}}"><img src="/video/thumbs/{{$featured->thumbnail}}" data-video-id="{{$featured->id}}" class="trackclick img-responsive" style="width: 100%" /></a>

                        <div class="ibox float-e-margins">
                            <div class="ibox-title clearfix">
                                <div class="pull-left">
                                    <h3><a href="video/watch/{{$featured->id}}" class="trackclick" data-video-id="{{$featured->id}}">{{$featured->title}}</a></h3>
                                    <p>{{$featured->views}} views &middot; {{$featured->sinceCreated}} ago</p>
                                    {{-- <h6>Tags:</h6>
                                    <span class="label">SOmething</span>
                                    <span class="label">SOm3thing totally different</span> --}}
                                </div>

                                <div class="pull-right">

                                </div>

                            </div>
                            <div class="ibox-content clearfix">
                                <p>{{$featured->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2><a href="video/playlists">Latest Playlists</a></h2>
                        </div>

                        <div class="ibox-content clearfix playlist-container">

                            @foreach($latestPlaylists as $lp)
                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <a href="video/playlist/{{$lp->id}}" class="trackclick" data-playlist-id="{{$lp->id}}"><img src="/video/thumbs/{{$lp->thumbnail}}" class="img-responsive" /></a>

                                    <div class="playlist-meta">
                                        <h4><a href="video/playlist/{{$lp->id}}" class="trackclick" data-playlist-id="{{$lp->id}}">{{$lp->title}}</a></h4>
                                        {!! $lp->description !!}
                                        <p>{{$lp->count}} videos &middot; {{$lp->sinceCreated}} ago</p>
                                    </div>
                                </div>
                            @endforeach


                            <a class="pull-right" href="video/playlists">&raquo; More Playlists</a>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2><a href="video/latest">Most Recent</a></h2>
                            </div>
                            <div class="ibox-content clearfix">
                                @foreach($mostRecent as $mr)
                                    <div class="col-xs-4 col-sm-3 col-lg-2 video-list-box">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <a href="video/watch/{{$mr->id}}" class="trackclick" data-video-id="{{$mr->id}}"><img src="/video/thumbs/{{$mr->thumbnail}}" class="embed-responsive-item img-responsive" /></a>
                                        </div>
                                        <a href="video/watch/{{$mr->id}}" class="trackclick" data-video-id="{{$mr->id}}"><h4>{{$mr->title}}</h4></a>
                                        <p>{{$mr->views}} views &middot; {{$mr->sinceCreated}} ago</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2><a href="video/popular">Most Viewed</a></h2>
                            </div>
                            <div class="ibox-content clearfix">
                                @foreach($mostViewed as $mv)
                                    <div class="col-xs-4 col-sm-3 col-lg-2 video-list-box">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <a href="video/watch/{{$mv->id}}" class="trackclick" data-video-id="{{$mv->id}}"><img src="/video/thumbs/{{$mv->thumbnail}}" class="embed-responsive-item img-responsive" /></a>
                                        </div>
                                        <a href="video/watch/{{$mv->id}}" class="trackclick" data-video-id="{{$mv->id}}"><h4>{{$mv->title}}</h4></a>
                                        <p>{{$mv->views}} views &middot; {{$mv->sinceCreated}} ago</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
            </div>

            <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2><a href="video/liked">Most Liked</a></h2>
                            </div>
                            <div class="ibox-content clearfix">
                                @foreach($mostLiked as $ml)
                                    <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <a href="video/watch/{{$ml->id}}" class="trackclick" data-video-id="{{$ml->id}}"><img src="/video/thumbs/{{$ml->thumbnail}}" class="embed-responsive-item img-responsive" /></a>
                                        </div>
                                        <a href="video/watch/{{$ml->id}}" class="trackclick" data-video-id="{{$ml->id}}"><h4>{{$ml->title}}</h4></a>
                                        <p>{{$ml->likes}} likes &middot; {{$ml->sinceCreated}} ago</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div> -->






                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/video/playPause.js?<?php echo time();?>"></script>

    @include('site.includes.modal')

</body>
</html>
