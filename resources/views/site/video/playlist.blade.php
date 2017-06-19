<!DOCTYPE html>
<html>

<head>
    @section('title', 'Video Playlist')

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

                <h1>{{$playlistMeta->title}}</h1>
                {!! $playlistMeta->description !!}
            </div>



            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins clearfix">

                            @foreach($videoList as $vl)

                            <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">

                                <div class="video-container">

                                    {{-- <a href="../watch/{{$vl->id}}"><img src="/video/thumbs/{{$vl->thumbnail}}" class="img-responsive" /></a> --}}
                                    <video class="video-overlay" controls="controls" poster="/video/thumbs/{{$vl->thumbnail}}" class="videoInPlaylist" id="video{{$vl->id}}">

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
                            @endforeach

                                <br class="clearfix" />


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
    <script type="text/javascript" src="/js/custom/site/video/playPause.js?<?php echo time();?>"></script>

    @include('site.includes.modal')

</body>
</html>
