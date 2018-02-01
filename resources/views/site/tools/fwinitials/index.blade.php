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

        .open {
            display: block;
            background-color: #b7e4ff !important;

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

                                    <h1>Product Deliveries</h1>

                                    <table class="table table-bordered departmenttable">
                                        <tr>
                                            <thead>
                                            <th></th>
                                            <th>LY Jan</th>
                                            <th>TY Jan</th>
                                            <th>LY Feb</th>
                                            <th>TY Feb</th>
                                            <th>LY Mar</th>
                                            <th>TY Mar</th>
                                            <th>LY Season Total</th>
                                            <th>TY Season Total</th>
                                            </thead>
                                        </tr>
                                        @foreach($departments as $department)
                                        <tr>
                                            <td><a class='department' data-department='{{ $department->name }}'>{{ $department->name }}</a></td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
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
