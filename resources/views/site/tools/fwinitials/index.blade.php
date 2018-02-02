<!DOCTYPE html>
<html>

<head>
    @section('title', 'Title')
    @include('site.includes.head')
    <style type="text/css">
        table{
            font-size: 11px;
        }
        .appendedtable td{
            background-color: white !important;
        }

        .open{
            font-weight: bold;
        }

        th.fixedwidthheader{
            width: 20%
        }

        th.monthly{
            width: 10%;
        }

        th.yearly{
            width: 10%;
        }


        .styletable tr:hover {
          background-color: #ffa !important;
        }

        .styletable tr:hover td.lastyear{
            background-color: #F6F6E1;
        }

        .styletable tr:hover td.lastyeartotal{
            background-color: #E6E6D0;
        }
        

        td.lastyear{
            background-color: #f3f3f3;
        }
        td.lastyeartotal{
            background-color: #ddd;
        }

    </style>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

        <div class="wrapper wrapper-content printable">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight">
                    <div class="mail-box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive clearfix">

                                    <h2>Product Deliveries: {{ ucfirst($division) }}</h2>

                                    <table class="table table-bordered departmenttable">
                                        <tr>
                                            <thead>
                                            <th class="fixedwidthheader"></th>
                                            <th class="monthly">LY {{ date('M', mktime(0, 0, 0, $window[0], 10)) }}</th>
                                            <th class="monthly">TY {{ date('M', mktime(0, 0, 0, $window[0], 10)) }}</th>
                                            <th class="monthly">LY {{ date('M', mktime(0, 0, 0, $window[1], 10)) }}</th>
                                            <th class="monthly">TY {{ date('M', mktime(0, 0, 0, $window[1], 10)) }}</th>
                                            <th class="monthly">LY {{ date('M', mktime(0, 0, 0, $window[2], 10)) }}</th>
                                            <th class="monthly">TY {{ date('M', mktime(0, 0, 0, $window[2], 10)) }}</th>
                                            <th class="yearly">LY Season Total</th>
                                            <th class="yearly">TY Season Total</th>
                                            </thead>
                                        </tr>
                                        @foreach($departments as $department)
                                        <tr>
                                            <td><i class="fa fa-caret-right"></i> <a class='department' data-department='{{ $department->name }}'>{{ $department->name }}</a></td>
                                            <td class='lastyear'>{{ $department->ly_month1 }}</td>
                                            <td>{{ $department->cy_month1 }}</td>
                                            <td class='lastyear'>{{ $department->ly_month2 }}</td>
                                            <td>{{ $department->cy_month2 }}</td>
                                            <td class='lastyear'>{{ $department->ly_month3 }}</td>
                                            <td>{{ $department->cy_month3 }}</td>
                                            <td class='lastyeartotal'>{{ $department->last_year_total }}</td>
                                            <td>{{ $department->current_year_total }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
           
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div id="view-style-modal" class="modal inmodal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                        <img class="styleImage" src="" alt="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    @include('site.includes.footer')

    @include('site.includes.scripts')

    @include('site.includes.modal')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/custom/site/tools/initials.js"></script>
</body>
</html>
