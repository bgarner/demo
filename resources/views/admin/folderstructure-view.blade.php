<html>
<head>
	<title></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
       <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
       <style type="text/css">
       	.folder-name{
			display:inline-block;
			color:#222222;
			font-size: 14px;
			font-family: Helvetica, ariel, sans-serif ;
			text-transform: capitalize;	
			line-height: 25px;
		}
		.add-folder{
			color: #222222;
			cursor: pointer;
		}
		.glyphicon-plus-sign{
			color:#228B22;
		}

       </style>
</head>
<body>
	<!-- navbar begins -->
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	    	<a class="navbar-brand">
		    	@if(isset($banner))
		    	<span>{{$banner->name}}</span> 
		    	@endif
	    	</a>
	    	
	    </div>
	    
		<ul class="nav navbar-nav">
			<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="/admin/folderstructure?banner_id=1">Sportchek</a></li>
	            <li><a href="/admin/folderstructure?banner_id=2">Atmosphere</a></li>
	          </ul>
	        </li>
	    </ul>
	    
	    <ul class="nav navbar-nav navbar-right">
        	<li><a href="/admin/home?banner_id={{$banner->id}}">View File Listing</a></li>
    	</ul>
	    </div>
	  
	</nav>
	<!-- navbar ends-->
	<div class="col-md-10 col-md-offset-1">
		
		<h3>Folders</h3>	

		<div >
			
			<div class="add-folder row">
				<i class="glyphicon glyphicon-plus-sign"></i>
				<span> Add New Folder </span>
			</div>
			<div class="row">
				 {!! Form::open(array('action' => 'FolderAdminController@store', 'files' => false, 'class' => 'form-horizontal', 'role' => 'form')) !!}
					{!! csrf_field() !!}
					<div id="form-container" class="col-md-3 input-group"></div>
				{!! Form::close() !!}
			</div>
			<div class="row">
				{!! csrf_field() !!}

				@foreach ($navigation as $nav) 
					
					@if ( $nav["is_child"] == 0)
						
						@include('admin.folderstructure-partial', ['navigation' =>$navigation, 'currentnode' => $nav, 'banner' => $banner])
						
					@endif


				@endforeach
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
 

	$(".add-folder").on("click", function() {
		$("#form-container").empty();
		$("#form-container").append('<input class="form-control" type="text" name="foldername" placeholder="Folder Name">'+
									'<span class="input-group-btn create-folder"><button class="btn btn-default" type="submit">Add</button></span>');
	})
	

	

</script>
</html>



