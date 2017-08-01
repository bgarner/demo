<!DOCTYPE html>
<html>

<head>
    @section('title', 'Video Playlist')

    @include('site.includes.head')

    
    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.css" rel="stylesheet">
    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css" rel="stylesheet">
    <!-- <link href="/js/plugins/videojs-playlist-ui/dist/advanced.css" rel="stylesheet"> -->

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
    
    body {
      font-family: Arial, sans-serif;
    }
    .preview-player-dimensions.vjs-fluid {
      padding-top: 41.66666666666667%;
    }

    .main-preview-player {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .video-js{
      position: relative;
      min-width: 300px;
      min-height: 150px;
      height: 0;
    }

    .video-js {
      flex: 3 1 70%;
    }

    .playlist-container {
      position: relative;
      min-width: 300px;
      min-height: 150px;
      height: 0;
    }
    .playlist-container {
      flex: 1 1 30%;
    }
    .vjs-playlist {
      margin: 0;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }
    .vjs-mouse.vjs-playlist .vjs-playlist-item {
        height: 106px;
        margin-bottom: 16px;
        font-size: 12px;
    }
    .vjs-playlist-title-container {
        bottom:35px !important;
    }
    .vjs-playlist .vjs-playlist-description{
        white-space: normal;
    }
    .vjs-playlist-now-playing-text {
        display: none !important;
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

                <h1>{{$playlistMeta->title}}</h1>
                {!! $playlistMeta->description !!}
            </div>



            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins clearfix">

                            {{--@foreach($videoList as $vl)

                            <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">

                                <div class="video-container">--}}

                                    {{-- <a href="../watch/{{$vl->id}}"><img src="/video/thumbs/{{$vl->thumbnail}}" class="img-responsive" /></a> --}}
                                    {{--<video class="video-overlay" controls="controls" poster="/video/thumbs/{{$vl->thumbnail}}" class="videoInPlaylist" id="video{{$vl->id}}">

                                        <source src="/video/{{$vl->filename}}" type="video/webm" />
                                    </video>
                                </div>

                                <div class="playlist-meta">
                                    <h4><a href="../watch/{{$vl->id}}" class="trackclick" data-video-id="{{$vl->id}}">{{$vl->title}}</a></h4>
                                    <p>{{$vl->description}}</p>
                                    <p>{{$vl->views}} {{__("views")}} &middot; {{$vl->sinceCreated}} {{__("ago")}}</p>
                                    <!-- <button class="btn btn-primary btn-outline videolikeplaylist" data-video-id="{{$vl->id}}" type="button" data-toggle="tooltip" data-placement="bottom" title="Like this"><i class="fa fa-thumbs-up"></i> {{$vl->likes}}</button>
                                    <button class="btn btn-danger btn-outline videodislikeplaylist" data-video-id="{{$vl->id}}" type="button" data-toggle="tooltip" data-placement="bottom" title="Dislike this"><i class="fa fa-thumbs-down"></i> {{$vl->dislikes}}</button> -->

                                </div>

                            </div>
                            @endforeach--}}
                            

                            <section class="main-preview-player">
                                <video id="preview-player" class="video-js vjs-fluid vjs-big-play-centered " controls preload="auto"
                                data-setup='{"controls": true, "autoplay": true, "preload": "auto", "fluid":true}'
                                >

                                </video>
                                <div class="playlist-container  preview-player-dimensions vjs-fluid">
                                <ol class="vjs-playlist"></ol>
                                </div>
                            </section>

                            </div>
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
    <script type="text/javascript" src="/js/custom/site/video/incViewCountFromPlaylist.js?<?php echo time();?>"></script>
    <script type="text/javascript" src="/js/custom/site/video/likedislike.js?<?php echo time();?>"></script>
    <!-- <script type="text/javascript" src="/js/custom/site/video/playPause.js?<?php echo time();?>"></script> -->
    <script src="/js/plugins/videojs-playlist/dist/videojs-playlist.js"></script>
    <script src="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.js"></script>

    @include('site.includes.modal')

    <script>
        var videoId = $(".video-js").attr('id');
        var player = videojs(videoId, {
            
        });

        player.playlist([
        {
              name: 'Disney\'s Oceans 1',
              description: 'Explore the depths of our planet\'s oceans. ' +
                'Experience the stories that connect their world to ours. ' +
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ' +
                'sed do eiusmod tempor incididunt ut labore et dolore magna ' +
                'aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' +
                'laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure ' +
                'dolor in reprehenderit in voluptate velit esse cillum dolore eu ' +
                'fugiat nulla pariatur. Excepteur sint occaecat cupidatat non ' +
                'proident, sunt in culpa qui officia deserunt mollit anim id est ' +
                'laborum.',
              duration: 45,
              sources: [
                { src: 'http://vjs.zencdn.net/v/oceans.mp4', type: 'video/mp4' },
                { src: 'http://vjs.zencdn.net/v/oceans.webm', type: 'video/webm' },
              ],
              // you can use <picture> syntax to display responsive images
              thumbnail: [
                {
                  srcset: '/js/plugins/videojs-playlist-ui/test/example/oceans.jpg',
                  type: 'image/jpeg',
                  media: '(min-width: 400px;)'
                },
                {
                  src: '/js/plugins/videojs-playlist-ui/test/example/oceans-low.jpg'
                }
              ]
        },
        {
          name: 'Disney\'s Oceans 2',
          description: 'Explore the depths of our planet\'s oceans. ' +
            'Experience the stories that connect their world to ours. ' +
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ' +
            'sed do eiusmod tempor incididunt ut labore et dolore magna ' +
            'aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' +
            'laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure ' +
            'dolor in reprehenderit in voluptate velit esse cillum dolore eu ' +
            'fugiat nulla pariatur. Excepteur sint occaecat cupidatat non ' +
            'proident, sunt in culpa qui officia deserunt mollit anim id est ' +
            'laborum.',
          duration: 45,
          sources: [
            { src: 'http://media.w3.org/2010/05/sintel/trailer.mp4', type: 'video/mp4' }
          ],
          // you can use <picture> syntax to display responsive images
          thumbnail: [
            {
              srcset: 'http://media.w3.org/2010/05/sintel/poster.png',
              type: 'image/jpeg',
              media: '(min-width: 400px;)'
            },
            {
              src: 'http://media.w3.org/2010/05/sintel/poster.png'
            }
          ]
        },
        {
          name: 'Disney\'s Oceans 3',
          description: 'Explore the depths of our planet\'s oceans. ' +
            'Experience the stories that connect their world to ours. ' +
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ' +
            'sed do eiusmod tempor incididunt ut labore et dolore magna ' +
            'aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' +
            'laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure ' +
            'dolor in reprehenderit in voluptate velit esse cillum dolore eu ' +
            'fugiat nulla pariatur. Excepteur sint occaecat cupidatat non ' +
            'proident, sunt in culpa qui officia deserunt mollit anim id est ' +
            'laborum.',
          duration: 45,
          sources: [
            { src: 'http://media.w3.org/2010/05/bunny/trailer.mp4', type: 'video/mp4' }
          ],
          // you can use <picture> syntax to display responsive images
          thumbnail: [
            {
              srcset: 'http://media.w3.org/2010/05/bunny/poster.png',
              type: 'image/jpeg',
              media: '(min-width: 400px;)'
            },
            {
              src: 'http://media.w3.org/2010/05/bunny/poster.png'
            }
          ]
        }
       ]);

    // Initialize the playlist-ui plugin with no option (i.e. the defaults).
    
    player.playlistUi();
    player.playlist.autoadvance(0);
    </script>

</body>
</html>
