<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tag: Tag Name')

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

                <h2>Tag: <i>Tag Name goes here</i></h2>

            </div>



            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins clearfix">

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">

                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />

                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>

                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">

                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />

                                    <div class="playlist-meta">
                                        <h4>This is a video has a ridiculously long title for no real reason, who would do this? </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>

                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />

                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">

                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

                                <div class="ibox-content clearfix col-xs-12 col-sm-12 col-lg-12 video-playlist-box">
                                    <img src="/images/video-placeholder.jpg" class="img-responsive" />
                                    <div class="playlist-meta">
                                        <h4>This is a video title</h4>
                                        <p>134,093 views &middot; 3 weeks ago</p>
                                    </div>
                                </div>

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

    @include('site.includes.modal')

</body>
</html>
