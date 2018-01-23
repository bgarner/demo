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


       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Dirty Nodes</h2>
            </div>
        </div>

        <div class="wrapper wrapper-content printable">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight mail-box-header">
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
                                <input class="dirtyNodeID" name="dirtyNodeID" type="hidden" value="{{ $d->id }}">
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

    <script>
        $(document).ready(function(){
            $('.dirtynodestable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
            });

            $('button.cleannode').on('click', function() {

                var id = $('#dirtyNodeDBID').val();
                console.log("from clic button func:  " +id);
                $.ajax({
                    url: window.location.href + "/clean/",
                    type: 'PATCH',
                    data: {
                        node_id : id
                    },
                    success: function(result) {
                        alert('success: ' + id);
                    }
                }).done(function(response){
                    alert('cleaned: ' + id);
                });
            })

            $('.dataTable').on('click', 'tbody td', function() {
                //<a href="#" data-toggle="modal" data-target="#dirtynodemodal">
                //console.log('API row values : ', table.row(this).data());
                $('#dirtynodemodal').modal('show');

                var id = $(this).closest("tr").find('input.dirtyNodeID').val();
                console.log(id);
                $('#dirtyNodeDBID').val(id);

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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</body>
</html>
