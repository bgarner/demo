<!DOCTYPE html>
<html>

<head>
    @section('title', 'Footwear Initials Tracker')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        .fa-plus-circle {
            color:#1ab394;
        }
        .fa-minus-circle {
            color:#ed5565;
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


       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Footwear Initials Tracker</h2>
                <small class="pull-right"> Last Updated :  </small>
            </div>
        </div>


        <div class="wrapper wrapper-content printable">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">


                    <table class="table table-bordered table-hover fwinitialsTable">
                        <thead>
                        <tr>

                            <th>Gender</th>
                            <th>LY July</th>
                            <th>TY July</th>
                            <th>LY Aug</th>
                            <th>TY Aug</th>
                            <th>LY Sept</th>
                            <th>TY Sept</th>
                            <th>LY Oct</th>
                            <th>TY Oct</th>

                            <th>LY Season 2 Total</th>
                            <th>TY Season 2 Total</th>
                            <th>data</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($fwinitials as $key=>$fw)
                          
                            <tr>                            
                                <td class="expand_gender" id="gender_{{$key}}"><i class="fa fa-plus-circle"></i> {{$fw->gender}}</td>
                                <td>{{$fw->ly_july}}</td>
                                <td>{{$fw->cy_july}}</td>
                                <td>{{$fw->ly_aug}}</td>
                                <td>{{$fw->cy_aug}}</td>
                                <td>{{$fw->ly_sept}}</td>
                                <td>{{$fw->cy_sept}}</td>
                                <td>{{$fw->ly_oct}}</td>
                                <td>{{$fw->cy_oct}}</td>
                                <td>{{$fw->last_year_total}}</td>
                                <td>{{$fw->current_year_total}}</td>
                                <td>{{$fw->category_totals}}</td>

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

    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/js/custom/site/tools/fwinitials.js"></script>

    <script>
    
        
    </script>

</body>
</html>
