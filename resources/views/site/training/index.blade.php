<!DOCTYPE html>
<html>

<head>
    @section('title', 'Training')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>

	<style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/dashboard-banners/ski.jpg') no-repeat 0px 50px;
        background-size: cover !important;
        overflow: hidden;
    }

    
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
			<h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px; margin-top: 0px; padding-top: 0px;">Training: Winter FY18</h1>



			<div class="ibox float-e-margins">
                <div class="ibox-content">
 					<div class="row">
 						<div class="col-md-8">

 							<a href="video/playlist/63"><img src="/video/thumbs/csahecc_png_23d6705471bcbc9d02892eb72327b6aa26ad2e5a.png" data-video-id="1" class="trackclick img-responsive" style="width: 100%"></a>
  							<h3><a href="video/playlist/63" class="trackclick" data-video-id="1">Back to Hockey</a></h3>
  							<p>348 views · 2 weeks ago</p>
  							<div class="ibox-content clearfix">
                                <p>Matt discusses some key information to prepare your teams for the upcoming Hockey Season! Be sure to check out all 5 videos.</p>
                            </div>
                    
 						</div>

 						<div class="col-md-4">
 							links
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
	                	<img src="/images/the-north-face-waterproof-jackets.jpg" class="img-responsive" />
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

		@include('site.includes.modal')


	</body>
	</html>
