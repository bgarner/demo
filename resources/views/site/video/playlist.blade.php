<!DOCTYPE html>
<html>

<head>
    @section('title', 'Video Playlist')

    @include('site.includes.head')

    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.css" rel="stylesheet">
    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css" rel="stylesheet">
    <link href="/css/custom/site/video/playlist.css" rel="stylesheet">

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

                <h1>{{$playlistMeta->title}}</h1>
                {!! $playlistMeta->description !!}
            </div>



            <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="ibox float-e-margins clearfix"> -->

                            <input type="text" id="videoList" hidden value="{{$videoList}}">


                            <section class="main-preview-player">
                                <video id="preview-player" class="video-js vjs-fluid vjs-big-play-centered " controls preload="auto"
                                data-setup='{"controls": true, "autoplay": true, "preload": "auto", "fluid":true}'
                                >

                                </video>
                                <div class="playlist-container  preview-player-dimensions vjs-fluid">
                                <ol class="vjs-playlist"></ol>
                                </div>
                            </section>

                            <div class="ibox float-e-margins video-details">
                                <div class="ibox-title clearfix">
                                    <div class="pull-left">
                                        <h3 id="video-title"></h3>
                                        <p>
                                            <span id="video-views" class="viewcount"></span> {{__("views")}} &middot;
                                            <span id="video-since"></span> {{__("ago")}}
                                        </p>
                                    </div>

                                </div>
                                <div class="ibox-content clearfix">
                                    <p id="video-description"></p>
                                    <input type="text" value="" class="hidden" id="video_id">
                                    <a id="clicktrack_link" class="trackclick hidden" data-video-id>Click to track</a>

                                    <hr />
                                    <h4><a href="../../video"><i class="fa fa-reply" aria-hidden="true"></i> Back to Video Library</a></h4>
                                </div>
                            </div>

                            <!-- </div> -->
                        </div>
                    </div>
                </div>

                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/plugins/videojs-playlist/dist/videojs-playlist.js"></script>
    <script type="text/javascript" src="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.js"></script>
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/video/incrementViewCountPlaylist.js?<?php echo time();?>"></script>
    <script type="text/javascript" src="/js/custom/site/video/loadPlaylist.js?<?php echo time();?>"></script>
    @include('site.includes.modal')

</body>
</html>
