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
            <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            side bar

            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Tasks</h2>
                        </div>
                    </div>

                </div>
                <div class="mail-box">
                    <ul class="todo-list m-t ui-sortable">
                                            <li>
                                                <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" name="" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                <span class="m-l-xs"><strong>Buy a milk</strong></span>
                                                <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                                                <P style="padding-left: 32px; font-size: 12px;line-height: 18px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                    <ul>
                                                        <li>sadasdasdasd</li>
                                                        <li>sadasdasdasd</li>
                                                        <li>sadasdasdasd</li>
                                                        <li>sadasdasdasd</li>
                                                    </ul>
                                            </li>
                                            <li>
                                                <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" value="" name="" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                <span class="m-l-xs">Go to shop and find some products.</span>
                                                <small class="label label-info"><i class="fa fa-clock-o"></i> 3 mins</small>
                                            </li>
                                            <li>
                                                <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" name="" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                <span class="m-l-xs">Send documents to Mike</span>
                                                <small class="label label-warning"><i class="fa fa-clock-o"></i> 2 mins</small>
                                            </li>
                                            <li>
                                                <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" name="" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                <span class="m-l-xs">Go to the doctor dr Smith</span>
                                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 42 mins</small>
                                            </li>
                                        </ul>
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
