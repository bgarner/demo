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
	                    <div class="ibox">
	                    	<div class="ibox-title">
	                    		<h2>Create New Store</h2>
	                    	</div>
	                    	<div class="ibox-content">
	                        <div class="form-group">
	                        	<label class="control-label">Store Name <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_name" id="store_name" value=""></div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="control-label">Store Number <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="control-label">Is this a combo store <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="control-label">Banner <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="control-label">Address </label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="control-label">City <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="control-label">Province <span class="req">*</span></label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="control-label">Postal Code </label>
	                            <div ><input type="text" class="form-control" name="store_number" id="store_number" value=""></div>
	                        </div>
	                        </div>
	                    </div>
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
