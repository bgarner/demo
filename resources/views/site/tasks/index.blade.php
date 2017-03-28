<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            side bar

            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Tasks</h2>
                        </div>
                    </div>

                </div>
                <div class="mail-box">

                </div>
            </div>
        </div>
    </div>

    @include('site.includes.footer')

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

    @include('site.includes.modal')

</body>
</html>
