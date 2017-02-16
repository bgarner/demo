<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" media="print" href="/css/print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" media="print" href="/css/plugins/fullcalendar/fullcalendar.print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/skins/manager/skin.css">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">

    <style>
    .circle{
        border-radius: 50%;
        width: 15px;
        height: 15px;
        font-size: 8px;
        text-align: center;
        padding: 1px;
        margin: 3px;
        display: inline-block;
        color: #fff;
    }
    .table-mail td{
        font-size: 12px;
    }
    </style>
</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div id="nav-header-content">
                            <div class="circle profile-circle">
                                DB
                            </div>

                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold profile-name">Dax Brewster</strong>
                                </span>
                                <span class="text-muted text-xs block">AVP - West</span>
                                <a href="/manager" class="no-style">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </span>
                        </div>

                    </li>

                    <li>
                        <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Thing 1</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Thing 2</span>  </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">Thing 3</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Thing 4</span></a>
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-magic"></i> <span class="nav-label">Thing 5 </span><span class="label label-info pull-right">62</span></a>
                    </li>

                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>


        </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">


            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    {{ $storeInfo->store_number }} {{ $storeInfo->name }}
                                </h2>
                                <h4>
                                    {{ $storeInfo->address }}<br />
                                    {{ ucwords(strtolower($storeInfo->city)) }}, {{ $storeInfo->province }}
                                </h4>

                                <small>
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered alteration in some form Ipsum available.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong>142</strong> Projects
                            </td>
                            <td>
                                <strong>22</strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Tags
                            </td>
                            <td>
                                <strong>32</strong> Friends
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <small>Sales in last 24h</small>
                    <h2 class="no-margins">206 480</h2>
                    <div id="sparkline1"></div>
                </div>


            </div>
            <div class="row">

                <div class="col-lg-4 col-md-4">

                    @if($urgentNoticeCount > 0)
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Urgent Notices</h3>
                        </div>
                    </div>
                    @endif

                    @if($alertCount >0)
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Alerts</h3>
                            @foreach($alerts as $alert)
                            title: {{ $alert->title }} <br />
                            id: {{ $alert->id }} <br />
                            document_id: {{ $alert->document_id }} <br />
                            alert_type_id: {{ $alert->alert_type_id }} <br />
                            since: {{ $alert->since }}<br />
                            link_with_icon: {{ $alert->link_with_icon }} <br />
                            <hr />
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Upcoming Product Launches</h3>
                        </div>
                    </div>


                </div>

                <div class="col-lg-5 col-md-5">

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Current Communications</h3>

                            <div class="mail-box">


                                <table class="table table-hover table-mail">
                                    <tbody>

                                    @foreach($communications as $communication)

                                    <tr class= "unread" >
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                        <td class="">
                                            <a class="" href="#">{{ $communication->subject }}</a><br />
                                            <small>{!! $communication->trunc !!}</small>
                                        </td>

                                        <td class="text-right">
                                            <small>
                                                {{ $communication->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small> -->
                                            </small>
                                        </td>
                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>


                            </div>

                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Tasks</h3>

                            <ul class="todo-list m-t ui-sortable">
                                <li>
                                    <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" name="" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                    <span class="m-l-xs">Buy a milk</span>
                                    <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
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
                <div class="col-lg-3 col-md-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Activity Timeline</h3>


                            <div class="circle bg-primary"><i class="fa fa-video-camera"></i></div><br />
                            <div class="circle bg-primary"><i class="fa fa-bullhorn"></i></div><br />
                            <div class="circle bg-primary"><i class="fa fa-bell"></i></div><br />
                            <div class="circle bg-primary"><i class="fa fa-book"></i></div><br />
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="/js/env.js"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <script src="/js/plugins/iCheck/icheck.min.js"></script>


</body>

</html>
