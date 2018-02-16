<!DOCTYPE html>
<html>

<head>
    @section('title', 'DOM Nodes')
    @include('site.includes.head')

 {{--    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> --}}
    <style>
        table{ width: 100% !important; }
        .table td{ font-size: 11px; }
        .table th{ font-size: 11px; } 

        .loading{
            position: fixed; /* Sit on top of the page content */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0; 
            left: 220px;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.8); /* Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;

        }
        .loading h1{
           position: relative;
            top: 40%;
            text-align: center;
            color: #fff;
        }
        .loadingimg{
            position: relative;
            top: 50%;
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
        <div class="loading"><h1>Loading DOM Nodes...<br /><img src="/images/ajax-loader.gif" class="loadingimg" /></h1></div>
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


<div class="wrapper wrapper-content  animated fadeInRight printable">

            <div class="row">
                <div class="col-lg-12">


<div class="ibox">
    <div class="ibox-title">
        <h2>DOM Nodes</h2>
        <div class="ibox-tools">
            <!-- <a class="btn btn-xs" id="videoReportModal">View Report by Date</a> -->
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

    </div>

    <div class="ibox-content">

        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Dirty Nodes </a></li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> Clean Nodes </a></li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-hover table-striped dirtynodestable" id="">
                                    <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th></th>
                                        <th>Style</th>
                                        <th>UPC</th>
                                        <th>Desc</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Start</th>
                                        {{--  <th>Week</th>  --}}
                                        <th>Qty</th>
                                        <th>Dept</th>
                                        <th>Sub-Dept</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $d)
                                        <tr id="nodeID_{{ $d->id }}">
                                            <td style="display: none;">{{ $d->id }}</td>
                                            <td><input type="button" class="cleannodebutton btn btn-sm btn-primary" value="Clean"></td>
                                            <td>{{ $d->stylecode }}</td>
                                            <td>{{ $d->upccode }}</td>
                                            <td>{{ $d->styledesc }}</td>
                                            <td>{{ $d->color }}</td>
                                            <td>{{ $d->sizename }}</td>
                                            <td>{{ $d->startdate }}</td>
                                            {{--  <td>{{ $d->week }}</td>  --}}
                                            <td>{{ $d->quantity }}</td>
                                            <td>{{ $d->department }}</td>
                                            <td>{{ $d->sub_department }}</td>
                                        </tr>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">  
                            <div class="col-md-12 table-responsive">
                                <table class="table table-hover table-striped cleannodestable" id="">
                                    <thead>
                                    <tr>
                                        <th>Style</th>
                                        <th>UPC</th>
                                        <th>Desc</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Start</th>
                                        {{--  <th>Week</th>  --}}
                                        <th>Qty</th>
                                        <th>Dept</th>
                                        <th>Sub-Dept</th>
                                        <th>Cleaned</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($cleanNodes as $cn)
                                        <tr>

                                            <td>{{ $cn->stylecode }}</td>
                                            <td>{{ $cn->upccode }}</td>
                                            <td>{{ $cn->styledesc }}</td>
                                            <td>{{ $cn->color }}</td>
                                            <td>{{ $cn->sizename }}</td>
                                            <td>{{ $cn->startdate }}</td>
                                            {{--  <td>{{ $cn->week }}</td>  --}}
                                            <td>{{ $cn->quantity }}</td>
                                            <td>{{ $cn->department }}</td>
                                            <td>{{ $cn->sub_department }}</td>
                                            <td>{{ $cn->updated_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

    @include('site.includes.footer')

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/js/custom/site/tools/dirtyNodes.js?<?=time();?>"></script>
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){
            //$('<div class="loading">Loading</div>').appendTo('body');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dirtynodestable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
                ordering: true,
                "initComplete": function( settings, json ) {
                     $('div.loading').remove();
                }
            });

            $('.cleannodestable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
                ordering: true
            });            

        });

    </script>

</body>
</html>
