
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title> @yield('title') </title>

	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="/css/font-awesome-animation.min.css" rel="stylesheet">

	{{-- <!-- Morris -->
	<link href="/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet"> --}}

	<link href="/css/animate.css" rel="stylesheet">
	<link href="/css/app.css" rel="stylesheet">

	<link href="/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="/css/plugins/chosen/chosen.css" rel="stylesheet">

	<link href="/css/vendor/jquery-ui.theme.min.css" rel="stylesheet">
	<link href="/css/vendor/dz.css" rel="stylesheet">
	<link href="/css/vendor/dropzone.css" rel="stylesheet">
	<link href="/css/vendor/lightbox.css" rel="stylesheet">
	<link href="/css/vendor/bootstrap-datetimepicker.min.css" rel="stylesheet">

	<link href="/css/custom/tree.css" rel="stylesheet">
	<link href="/css/custom/document-upload.css" rel="stylesheet">
	<link href="/css/custom/package.css" rel="stylesheet">

	<link href="/css/print.css" rel="stylesheet" media="print">

	<style>
		.modal-lg{ height: 95%; width: 80% !important; padding: 0; }
		.modal-content{ height: 100% !important;}
		.modal-body{ padding: 10px; margin: 0; height: 100% !important; }
			.modal-body .document-checkbox {
				margin-left: 10px;
			}

	#folder-listing .modal-dialog, #document-listing .modal-dialog, #package-listing .modal-dialog, #video-listing .modal-dialog{
	  height:95%;
	}

	#folder-listing .modal-header, #document-listing .modal-header, #package-listing .modal-header{
	  position: absolute;
	  top: 10px;
	  width: 100%;
	}
	#video-listing .modal-header{
	  position: absolute;
	  width: 100%;
	}

	#folder-listing .modal-body, #document-listing .modal-body, #package-listing .modal-body{
	  position: absolute;
	  top: 70px;
	  width: 100%;
	  height: 95% !important;
	  padding:10px;
	}
	#video-listing .modal-body{
	  position: absolute;
	  top: 95px;
	  width: 100%;
	  height: 93% !important;
	  padding:10px;
	}

	#folder-listing .modal-body .tree, #document-listing .modal-body .tree, #package-listing .modal-body .tree, #video-listing .modal-body .tree{
	  	height: 90% !important;
	  	overflow-y: auto;
	 	padding-left: 25px;
    	line-height: 25px;
	}

	#folder-listing .modal-footer, #document-listing .modal-footer, #package-listing .modal-footer, #video-listing .modal-footer {
	  position: absolute;
	  bottom: 10px;
	  width: 100%;
	}
	</style>  

	{{-- <link href="/css/plugins/summernote/summernote-bs3.css" rel="stylesheet"> --}}

	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">