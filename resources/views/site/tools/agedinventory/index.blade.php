<!DOCTYPE html>
<html>

<head>
    @section('title', 'Aged Inventory')
    @include('site.includes.head')

    {{--  <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">  --}}
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
            z-index: 1000; /* Specify a stack order in case you're using a different order for other elements */
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
    <div class="loading"><h1>Loading Inventory...<br /><img src="/images/ajax-loader.gif" class="loadingimg" /></h1></div>
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
                                <div class="col-md-12 table-responsive">

                  


                    <table class="table table-hover table-striped agedInventoryTable" id="">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Assortment</th>
                            <th>Style</th>
                            <th>Product Name</th>
                            <th>Qty On Hand</th>
                            <th>Location</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $p)

                            <tr>
                                <td>{{ $p->category }}</td>
                                <td>{{ $p->assortment }}</td>
                                <td>{{ $p->style_colour }}</td>
                                <td>{{ $p->style_name }}</td>
                                <td>{{ $p->on_hand }}</td>
                                <td>
                                    @if( $p->location_front == 0)
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Front' data-checked='{{ $p->location_front }}' class="btn setlocation btn-sm btn-outline btn-default front">Front</button>
                                    @else
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Front' data-checked='{{ $p->location_front }}' class="btn setlocation btn-sm btn-success front"><i class="fa fa-check" aria-hidden="true"></i> Front</button>
                                    @endif
                                    
                                    {{--  @if( $p->location_back == 0)
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Back' data-checked='{{ $p->location_back }}' class="btn setlocation btn-sm btn-outline btn-default back">Back</button>
                                    @else
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Back' data-checked='{{ $p->location_back }}' class="btn setlocation btn-sm btn-success back"><i class="fa fa-check" aria-hidden="true"></i> Back</button>
                                    @endif  --}}

                                </td>
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

    @include('site.includes.footer')

    @include('site.includes.scripts')
    @include('site.includes.modal')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>    
    <script src="/js/custom/site/tools/agedInventory.js?<?=time();?>"></script>

    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.agedInventoryTable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
                ordering: true,
                "initComplete": function( settings, json ) {
                     $('div.loading').remove();
                }
            });

        });

    </script>

</body>
</html>
