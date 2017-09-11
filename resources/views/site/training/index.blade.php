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
			<h4>This is the title</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
				<div class="col-md-3">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						HG
	                	</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						SG
	                	</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						FW
	                	</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="ibox float-e-margins">
	                	<div class="ibox-content">
	 						People
	                	</div>
					</div>
				</div>												
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
