<!DOCTYPE html>
<html>

<head>
    @section('title', 'Stores')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
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
	                    
	                </div>
	            </div>


	        </div>
	    </div>
	</div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')

	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

        $(".datatable").DataTable({
            
        });

	</script>

	<script src="/js/custom/admin/stores/createStore.js"></script>

	@include('site.includes.bugreport')



</body>
</html>
