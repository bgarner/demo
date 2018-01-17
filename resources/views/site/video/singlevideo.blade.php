<!DOCTYPE html>
<html>

<head>
    @section('title', $video[0]->title)

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



            <div class="row">
                <div class="col-lg-12">
                    <br />
                    <video
                        class="video-js vjs-default-skin vjs-big-play-centered"
                        id="video_{{$video[0]->id}}"
                        data-setup='{"controls": true, "autoplay": true, "preload": "auto", "fluid": true}'
                        >
                        <source src="/video/{{$video[0]->filename}}" type="video/webm" />
                    </video>                    
{{--                     <video
                        class="video-js vjs-default-skin vjs-big-play-centered"
                        poster="/video/thumbs/{{$video[0]->thumbnail}}"
                        id="video_{{$video[0]->id}}"
                        data-setup='{"controls": true, "autoplay": true, "preload": "auto", "fluid": true}'
                        >
                        <source src="/video/{{$video[0]->filename}}" type="video/webm" />
                    </video> --}}

                    <div class="ibox float-e-margins">
                        <div class="ibox-title clearfix">
                            <input type="hidden" id="video_id" value="{{$video[0]->id}}" />
                            <div class="pull-left">
                                <h1>{{ $video[0]->title }}</h1>
                                {{-- <h6>Tags:</h6>
                                <a href=""><span class="label">SOmething</span></a>
                                <a href=""><span class="label">SOm3thing totally different</span></a> --}}
                            </div>

                            <div class="pull-right">
                                    <h2 class="viewcount">{{$video[0]->views}} {{__("views")}}</h2>
                                    <!-- <div class="progress progress-mini" style="margin-bottom: 10px;">
                                        <div style="width: {{$video[0]->ratio}}%;" class="progress-bar"></div>
                                    </div> -->
                                    <!--
                                    <button class="btn btn-primary btn-outline" id="videolike" type="button" data-toggle="tooltip" data-placement="bottom" title="Like this"><i class="fa fa-thumbs-up"></i> {{$video[0]->likes}}</button>
                                    <button class="btn btn-danger btn-outline" id="videodislike" type="button" data-toggle="tooltip" data-placement="bottom" title="Dislike this"><i class="fa fa-thumbs-down"></i> {{$video[0]->dislikes}}</button>
                                    -->
                            </div>

                        </div>
                        <div class="ibox-content clearfix">
                            <p>{{$video[0]->description}}</p>
                            <div class="tag-list">
                                @foreach($tags as $t)
                                    <a href="../../tag/{{ $t->linkname }}"><span class="badge">{{ $t->name }}</span></a>
                                @endforeach
                            </div>

                            @if( count($playlists) > 0)
                                <hr />
                                <h2>{{__("Related Playlists")}}</h2>
                                @foreach($playlists as $playlist)
                                    <h4><i class="fa fa-list" aria-hidden="true"></i> <a href="../playlist/{{$playlist->id}}">{{ $playlist->title }}</a></h4>
                                @endforeach

                            @endif
                            <hr />
                            <h4><a href="../../video"><i class="fa fa-reply" aria-hidden="true"></i> Back to Video Library</a></h4>
                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Related Videos</h2>
                            </div>
                            <div class="ibox-content clearfix">

                                <div class="col-xs-6 col-sm-4 col-lg-3 video-list-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <h4>This is a video title</h4>
                                    <p>134,093 views &middot; 3 weeks ago</p>
                                </div>



                            </div>
                        </div>
                    </div>
            </div> --}}


                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/video/incrementViewCount.js?<?php echo time();?>"></script>
    <script type="text/javascript" src="/js/custom/site/video/likedislike.js?<?php echo time();?>"></script>

    @include('site.includes.modal')

</body>
</html>
