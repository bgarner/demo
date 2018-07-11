<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Store Structure')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
		body {
		  /*background-color: #8e44ad;*/
		  /*margin: 0;
		  display: flex;
		  justify-content: center;
		  align-items: center;*/
		}


		.scrolling-wrapper {
		   	display: flex;
		   	flex-wrap: nowrap;
		    overflow-x: scroll;
		    border: thin solid red;
		    

		}
		.scrolling-wrapper::-webkit-scrollbar {
		  /*display: none;*/
		}
		.scrolling-wrapper .card {
		    flex: 0 0 auto;
		    height:500px;
		    /*width:500px;*/
		    margin: 10px;
		    border: thin solid lime;
		}
		  
	</style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >

		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Store Structure</h5>

                        </div>
                        <div class="ibox-content storestructure-container" >
							<div class="scrolling-wrapper">
							  <div class="card"><h3>Stores</h3></div>
							  <div class="card"><h3>Districts</h3></div>
							  <div class="card"><h3>Regions</h3></div>
							  
							</div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')

	

	<script type="text/javascript" src="/js/custom/admin/storegroup/deleteStoreGroup.js"></script>
	<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
	<script type="text/javascript">
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

	</script>
	@include('site.includes.bugreport')


</body>
</html>
