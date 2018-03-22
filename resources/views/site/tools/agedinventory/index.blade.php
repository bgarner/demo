<!DOCTYPE html>
<html>

<head>
    @section('title', 'Aged Inventory')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

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
                <h2>Aged Inventory</h2>
                {{--  <small class="pull-right"> Last Updated : {{ $last_updated }} </small>  --}}
            </div>
        </div>


        <div class="wrapper wrapper-content printable">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">


                    <table class="table table-bordered table-hover agedInventoryTable" id="">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Assortment</th>
                            <th>Product Name</th>
                            <th>Qty On Hand</th>
                            <th>Location</th>
                        </tr>
                        </thead>

                        <tbody>
                        {{--  @foreach($data as $d)

                            @if($d->week)
                            <tr class="highlight">
                            @else
                            <tr>
                            @endif
                                <td>{{ substr($d->class, 8) }}</td>
                                <td>{{ substr($d->gender, 7) }}</td>
                                <td>{{ $d->brand }}</td>
                                <td>{{ $d->style }}</td>
                                <td>{{ $d->style_name }}</td>
                                <td>{{ $d->colour }}</td>
                                <td>{{ $d->size }}</td>
                                <td>{{ $d->on_hand }}</td>
                                <td>{{ $d->in_transit }}</td>
                                <td>{{ $d->on_order }}</td>
                                <td>
                                    @if($d->week)
                                        <center>
                                        {!!$d->week!!}
                                        </center>
                                    @endif
                                </td>
                            </tr>

                        @endforeach  --}}

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

    @include('site.includes.scripts')
    @include('site.includes.modal')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    

    <script>
        $(document).ready(function(){
            $('.agedInventoryTable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
                // "order": [[ 8, 'asc' ], [ 9, 'asc' ]]
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
