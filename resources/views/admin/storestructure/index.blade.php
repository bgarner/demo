<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Store Structure')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
		.scrolling-wrapper-flexbox {
		  display: flex;
		  flex-wrap: nowrap;
		  overflow-x: auto;
		}

		  .card {
		  	border: thin solid lime;
		    flex: 0 0 auto;
		  }
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
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
							  <div class="card"><h2>Card</h2></div>
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
