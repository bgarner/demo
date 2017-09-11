<!DOCTYPE html>
<html>

<head>
    @section('title', 'Training')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.css" rel="stylesheet">
    <link href="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css" rel="stylesheet">

	<style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/dashboard-banners/ski.jpg') no-repeat 0px 50px;
        background-size: cover !important;
        overflow: hidden;
    }
    #file-table tr td:last-child {
        white-space: nowrap;
        width: 1%
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
      flex: 3 1 60%;
    }

    .playlist-container {
      position: relative;
      min-width: 120px;
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
        line-height: 16px !important;
        display: inline-block;
        position: absolute;
        top:20px;
        /*width: 55%;*/
        text-overflow: ellipsis !important;
    }
    .vjs-playlist-now-playing-text {
        display: none !important;
    }
    .vjs-playlist-name {
        position: absolute;
        bottom: 5.4rem;
        left: 13rem;
    }
    </style>
    
    </style>

</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg">
	
		<div id="background-caption" class="hide">
			<h4>Diederich Wolfgang - P/T Footwear Associate - 314 West Edmonton Mall</h4>
			<p>Diederich is a hardcore skiier, obvs. He thinks he will be in one of those Warren Miller DVDs. That's the reason we are featuring a picture of him skiing. Seriously. Have you ever had a powder day like this? I don't know how Diederich affords to find this powder on his part-time wage, but he does. He might have something on the side.</p>
		</div>

		<div class="row border-bottom">
			@include('site.includes.topbar')
        </div>

        <div class="wrapper wrapper-content">
			<h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px; margin-top: 0px; padding-top: 0px;">Winter FY18</h1>



			<div class="ibox float-e-margins">
                <div class="ibox-content">
 					<div class="row">
 						<div class="col-md-8">

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

{{--  							<a href="video/playlist/63"><img src="/video/thumbs/csahecc_png_23d6705471bcbc9d02892eb72327b6aa26ad2e5a.png" data-video-id="1" class="trackclick img-responsive" style="width: 100%"></a>
 --}}
 						</div>

 						<div class="col-md-4">
 							<h1><a href="video/playlist/63" class="trackclick" data-video-id="1">Back to Hockey</a></h1>
 							<small>348 views · 2 weeks ago</small>
 							<p>Matt discusses some key information to prepare your teams for the upcoming Hockey Season! Be sure to check out all 5 videos.</p>
 							<a class="btn btn-primary btn-lg dim btn-outline" type="button" style="width: 100%;">
 								<i class="fa fa-file-o"></i> Back to Hockey Documents
 							</a>
 							<a class="btn btn-primary btn-lg dim btn-outline" type="button" style="width: 100%;">
 								<i class="fa fa-film"></i> More Hockey Videos
 							</a>
 							<a class="btn btn-primary btn-lg dim btn-outline" type="button" style="width: 100%;">
 								<i class="fa fa-question-circle"></i> Ask The Trainer
 							</a>
 			{{-- 				<a class="btn btn-danger btn-lg dim btn-outline" type="button" style="width: 100%;">
 								<i class="fa fa-history"></i> Previous Features
 							</a> --}}

 						</div>
 					</div>
 {{-- 					<div class="row">
 						<div class="col-md-12">
 						tags
 						</div>
 					</div> --}}
                </div>
			</div>

			<div class="row">
				<a href="#">
				<div class="col-md-3">
					<div class="widget navy-bg no-padding ibox">
	                	<div class="p-m">
                        <h1 class="m-xs">Hardgoods</h1>
						</div>
	                	<img src="/images/cut.jpg" class="img-responsive" />
					</div>
				</div>
				</a>


				<a href="#">
				<div class="col-md-3">
					<div class="widget yellow-bg no-padding ibox">
	                	<div class="p-m">
                        <h1 class="m-xs">Softgoods</h1>
						</div>
	                	<img src="/images/cut.jpg" class="img-responsive" />
					</div>
				</div>
				</a>

				<a href="#">
				<div class="col-md-3">
					<div class="widget red-bg no-padding ibox">
	                	<div class="p-m">
                        <h1 class="m-xs">Footwear</h1>
						</div>
	                	<img src="/images/cut.jpg" class="img-responsive" />
					</div>
				</div>
				</a>


				<a href="#">
				<div class="col-md-3">
					<div class="widget lazur-bg no-padding ibox">
	                	<div class="p-m">
                        <h1 class="m-xs">People</h1>
						</div>
	                	<img src="/images/cut.jpg" class="img-responsive" />
					</div>
				</div>
				</a>											
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						comm
	                	</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						updates
	                	</div>
					</div>
				</div>				
			</div>

   		</div>

		@include('site.includes.footer')

	    @include('site.includes.scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/video/incViewCountFromPlaylist.js?<?php echo time();?>"></script>
    <script type="text/javascript" src="/js/custom/site/video/incrementViewCount.js?<?php echo time();?>"></script>
    <script type="text/javascript" src="/js/custom/site/video/likedislike.js?<?php echo time();?>"></script>
    <script src="/js/plugins/videojs-playlist/dist/videojs-playlist.js"></script>
    <script src="/js/plugins/videojs-playlist-ui/dist/videojs-playlist-ui.js"></script>	    

		@include('site.includes.modal')

    <script>
        var videoId = $(".video-js").attr('id');
        var player = videojs(videoId, {
            
        });
        var videoList = JSON.parse($("#videoList").val());
        $(videoList).each(function(index){
            var video = videoList[index].duration;
            videoList[index].duration = video;
        })
        player.playlist(videoList);
        var video = videoList[0];
        $(".video-details").find("#video-title").text(video.name);
        $(".video-details").find("#video-views").text(video.views);
        $(".video-details").find("#video-since").text(video.sinceCreated);
        $(".video-details").find("#video-description").text(video.description);
        $(".video-details").find("#clicktrack_link").attr('data-video-id', video.id).trigger('click');
        $("#video_id").val( video.id );



    // Initialize the playlist-ui plugin with no option (i.e. the defaults).
    
    player.playlistUi();
    player.playlist.autoadvance(0);
    player.on('loadedmetadata', function() {
        var duration = player.duration();
    });

    player.on('playlistitem', function() {
      var index = player.playlist.currentItem();
      var video = videoList[index];
      $(".video-details").find("#video-title").text(video.name);
      $(".video-details").find("#video-views").text(video.views);
      $(".video-details").find("#video-since").text(video.sinceCreated);
      $(".video-details").find("#video-description").text(video.description);
      $(".video-details").find("#clicktrack_link").attr('data-video-id', video.id).trigger('click');
      $.ajax({
        url : '/videocount',
        type: 'POST',
        data: {
            id: video.id,
        },
    }).done(function( data ){
        $(".video-details").find("#video-views").text(data);
    });

    });
    </script>
	</body>
	</html>
