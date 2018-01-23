<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dirty Nodes')
    @include('site.includes.head')

 {{--    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> --}}
    <style>
        /* .table td{ font-size: 10px; }
        .table th{ font-size: 11px; } */
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
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover dirtynodestable" id="">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Description</th>
                                        <th>UPC</th>
                                        <th>Start Date</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $d)
                                        <tr>
                                            <input type="hidden" class="dirtyNodeID" value="{{ $d->id }}">
                                            <td>{{ $d->item_id }}</td>
                                            <td>{{ $d->desc }}</td>
                                            <td>{{ $d->UPC }}</td>
                                            <td>{{ $d->start_date }}</td>
                                            <td>{{ $d->quantity }}</td>
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
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover cleannodestable" id="">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Description</th>
                                        <th>UPC</th>
                                        <th>Start Date</th>
                                        <th>Quantity</th>
                                        <th>Cleaned At</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($cleanNodes as $cn)
                                        <tr>
                                            <td>{{ $cn->item_id }}</td>
                                            <td>{{ $cn->desc }}</td>
                                            <td>{{ $cn->UPC }}</td>
                                            <td>{{ $cn->start_date }}</td>
                                            <td>{{ $cn->quantity }}</td>
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
    <script src="/js/custom/site/tools/flyerPages.js"></script>
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dirtynodestable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
            });

            $('.cleannodestable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
            });            

            $('.dirtynodestable').on('click', 'tbody td', function() {

                $('#dirtynodemodal').modal('show');

                var id = $(this).closest("tr").find('input.dirtyNodeID').val();
                console.log("populate the hidden field:" + id);
                $('span#dirtyNodeDBID').text(id);

                var itemID = $(this).closest("tr").find('td:eq(0)').text();
                $('#dirtyNodeItemID span.value').text(itemID);

                var desc = $(this).closest("tr").find('td:eq(1)').text();
                $('#dirtyNodeTitle').text(desc);

                var upc = $(this).closest("tr").find('td:eq(2)').text();
                $('#dirtyNodeUPC span.value').text(upc);

                //var start_date = $(this).closest("tr").find('td:eq(3)').text();
                var qty = $(this).closest("tr").find('td:eq(4)').text();
                $('#dirtyNodeQuantity span.value').text(qty);
            });

        });

        $('button.cleannode').on('click', function() {
            var id = $('span#dirtyNodeDBID').text();
            console.log('from click: ' + id);
            $.ajax({
                url: window.location.href + "/clean/",
                type: 'PATCH',
                data: {
                    node_id : id
                },
                success: function(result) {
                    
                }
            }).done(function(response){
                swal("Good job 🍭!", "Node is clean!", "success");
            });
        });        


    </script>

</body>
</html>
