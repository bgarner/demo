<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('manager.includes.head')

    @yield('style')

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
            {{-- @include('manager.includes.topbar') --}}
        </div>


        @yield('content')
    </div> <!-- page wrapper -->
    </div> <!-- wrapper -->


    @include('manager.includes.footer')

    @include('manager.includes.scripts')
    <script src="/js/custom/manager/getArchivedContent.js?<?=time();?>"></script>
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

    @yield('scripts')
    @include('site.includes.modal')

</body>
</html>
