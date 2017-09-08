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
	

		<div class="row border-bottom">
			@include('site.includes.topbar')
        </div>

        <div class="wrapper wrapper-content">
               <h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px; margin-top: 0px; padding-top: 0px;">Training: Winter FY18</h1>

   </div>

		@include('site.includes.footer')

	    @include('site.includes.scripts')

		@include('site.includes.modal')


	</body>
	</html>
