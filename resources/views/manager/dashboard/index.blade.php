<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('manager.includes.head')

</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('manager.includes.nav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('manager.includes.topbar')
        </div>


    <div class="wrapper wrapper-content">
       
    </div> <!-- class wrapper closes -->
    </div> <!-- page wrapper -->
    </div> <!-- wrapper -->


    @include('manager.includes.footer')

    @include('manager.includes.scripts')
    <!-- <script src="/js/custom/manager/getArchivedContent.js?<?=time();?>"></script> -->
    <script src="/js/plugins/iCheck/icheck.min.js"></script>


    @include('site.includes.modal')

</body>
</html>
