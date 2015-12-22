<html>
<head>
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/vendor/jquery-ui.theme.min.css">
  <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/vendor/dz.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/custom/document-upload.css">
  <link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">
  <link rel="stylesheet" type="text/css" href="/css/custom/package.css">

</head>
<body class="container-fluid">
  <!-- navbar begins -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand">
          @if(isset($banner))
          <span>{{$banner->name}}</span>
          <input type="hidden" name="banner_id" value="{{$banner->id}}">
          @endif
        </a>
        
      </div>
      
    <ul class="nav navbar-nav">
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/home?banner_id=1">Sportchek</a></li>
            <li><a href="/admin/home?banner_id=2">Atmosphere</a></li>
          </ul>
      </li>
    </ul>
   
    </div>
    
  </nav>
  <!-- navbar ends-->
  <div id="admin-container" >
    
    <!-- <div class="row"> -->
  		<div class="navigation-container">
  			<!-- <div class="ui-widget-content"> -->
        <div id="admins">
          <h4>Admins</h4>
        </div>
         
        <div id="banners">  
          <h4>Banners</h4>
        </div>
        
        <h4>Folders</h4>
          @include('admin.navigation-view', ['navigation'=>$navigation])
        <h4>Packages</h4>
          <a href="/admin/package/create?banner_id={{$banner->id}}"> Create New Package</a>
          <br>
          @include('admin.package.list', ['packages'=>$packages])
        <h4>Communications</h4>
          <a href="/admin/communication/create?banner_id={{$banner->id}}"> Create New Communication</a>
          <br>
          <a href="/admin/communication?banner_id={{$banner->id}}">View Communications</a>
  		</div>
  		<div class="content-container">
        <div id="empty-container" class="visible">
          <h4>Select a folder to view</h4>
        </div>
        <div id="file-container" class="hidden">
          <ol class="breadcrumbs"></ol>
          <input type="hidden" name="default_folder" value={{$defaultFolder}}>
          @include('admin.document-table')
        </div>
        <div id="package-viewer" class="hidden">
          @include('admin.package.view')
        </div>
        <div id="user-viewer" class="hidden">
          @include('superadmin.user.view')
        </div>
        <div id="file-uploader" class="hidden">
          <div id="watermark">Drag and drop documents here</div>
          @include('admin.document-upload')
        </div>

  		</div>

  	<!-- </div> -->
  </div>
</body>
<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/custom/tree.js"></script>
<script type="text/javascript" src="/js/custom/folderStructure.js" ></script>
<script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
<script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
<script type="text/javascript" src="/js/custom/admin/documents/getPackages.js"></script>
<script type="text/javascript" src="/js/custom/admin/documents/deletePackage.js"></script>
<script type="text/javascript" src="/js/custom/admin/documents/showPackage.js"></script>
<script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
<script type="text/javascript" src="/js/vendor/dropzone.js"></script>
<script type="text/javascript" src="/js/custom/uploadDocument.js"></script>
<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
<script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
<script type="text/javascript" src="/js/custom/superadmin/home.js"></script>
<script type="text/javascript" src="/js/custom/superadmin/user/fillUserTable.js"></script>
<script type="text/javascript" src="/js/custom/superadmin/user/deleteUser.js"></script>


<script>
	$(document).ready(function() {

    $(".dropdown-toggle").dropdown();
		$(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});
    
    var defaultFolderId = $("input[name='default_folder']").val();
    if (defaultFolderId) {
      var folder = $("#"+defaultFolderId);
      $("#"+defaultFolderId).parent().click();
      $.ajax(
      {
        url : '/admin/document',
        data : {
              folder : defaultFolderId,
              isWeekFolder : folder.attr("data-isweek")
             }
      }
      )
      .done(function(data){
        console.log(data);
        fillTable(data);
      });

    }

    
    $( ".navigation-container" ).resizable();

         
	});  

</script>
</html>

