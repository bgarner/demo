<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flash Sale Tracker')
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
                <h2>DOM Flash Sale Tracker</h2>
                <p>Sale Date: July 20, 2017</p>
                <small class="pull-right"> Last Updated : {{ $last_updated }} </small>
            </div>
        </div>


        <div class="wrapper wrapper-content printable">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">


                    <table class="table table-bordered table-hover flashsaletable" id="">
                        <thead>
                        <tr>
                            <th>Department</th>
                            <th>Sub-Department</th>
                            <th>Class</th>
                            <th>Sub-Class</th>
                            <th>Style Number</th>
                            <th>Style Name</th>
                            <th>Size</th>
                            <th>Colour</th>
                            <th>On Hand</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $d)

                            <tr>
                                <td>{{ $d->department }}</td>
                                <td>{{ $d->subdepartment }}</td>
                                <td>{{ $d->class }}</td>
                                <td>{{ $d->subclass }}</td>
                                <td>{{ $d->style_number }}</td>
                                <td>{{ $d->style_name }}</td>
                                <td>{{ $d->size }}</td>
                                <td>{{ $d->colour }}</td>
                                <td>{{ $d->on_hand }}</td>

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
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script>
        $(document).ready(function(){
            $('.flashsaletable').DataTable({
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
