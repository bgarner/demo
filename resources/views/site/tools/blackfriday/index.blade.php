<!DOCTYPE html>
<html>

<head>
    @section('title', 'Door-Crasher Tracker')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        .table td{ font-size: 11px; }
        .table th{ font-size: 11px; }

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


       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Door-Crasher Tracker</h2>
            </div>
        </div>        


        <div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">




                    <div class="table-responsive clearfix">

                    
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                    <thead>
                    <tr>
                        <th>Dept</th>
                        <th>SubDept</th>
                        <th>Class</th>
                        <th>Style</th>
                        <th>Name</th>
                        <th>On Hand</th>
                        <th>In Transit</th>
                        <th>Total</th>
                        <th>Ad Page</th>
                        <th>Ad Box</th>
                        <th>Ad Min</th>                        
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->dpt_name }}</td>
                        <td>{{ $d->sdpt_name }}</td>
                        <td>{{ $d->cls_name }}</td>
                        <td>{{ $d->style_number }}</td>
                        <td>{{ $d->style_name }}</td>
                        <td>{{ $d->oh_qty }}</td>
                        <td>{{ $d->it_qty }}</td>
                        <td>{{ $d->total_onhand_intransit }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
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



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')

    @include('site.includes.modal')

    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
    
                responsive: true

            });

        });

    </script>    

    <script>

        $(function () {
            $('#event_date').datetimepicker({
                format: "MM/DD/YYYY"
            });

            $('#pickup_date').datetimepicker({
                format: "MM/DD/YYYY"
            });
        });
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
    </script>

</body>
</html> 