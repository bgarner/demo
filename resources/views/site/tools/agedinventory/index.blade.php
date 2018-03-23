<!DOCTYPE html>
<html>

<head>
    @section('title', 'Aged Inventory')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        td{ font-size: 11px; }
        table button{ float: left; margin-right: 5px;}
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


                    <table class="table table-bordered table-hover nowrap agedInventoryTable" id="">
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
                                    
                                    @if( $p->location_back == 0)
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Back' data-checked='{{ $p->location_back }}' class="btn setlocation btn-sm btn-outline btn-default back">Back</button>
                                    @else
                                    <button type="button" data-id='{{ $p->id }}' data-loc='Back' data-checked='{{ $p->location_back }}' class="btn setlocation btn-sm btn-success back"><i class="fa fa-check" aria-hidden="true"></i> Back</button>
                                    @endif

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

        $( ".setlocation" ).click(function() {

            //get the id, etc of the item we are setting
            var storenumber = localStorage.getItem('userStoreNumber').replace("A", "");
            if(storenumber.charAt(0) == "0"){
                storenumber = storenumber.slice(1);	
            }
            var id = $(this).data('id');
            var loc = $(this).data('loc');  //front or back
            var checked = $(this).data('checked');  //set or not
            var action;
            if(checked == 1){
                action = "unset";
            } else {
                action = "set";
            }

             //add the spinner... fa fa-spinner fa-spin
            $(this).removeClass('btn-default btn-outline').addClass('btn-warning').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating...');
            
            var $t = $(this); //setting the "this" so we can use in the ajax block...
            $.ajax({
                url: "/tools/agedinventory/update",
                type: 'patch',
                data: {
                    storenumber: storenumber,
                    id: id,
                    location: loc, //front or back
                    action: action //set or unset
                },
                success: function(result) {
                }
            }).done(function(response){
                //$(element).closest("tr").after( table );
                    if(action == "set"){
                        $t.removeClass('btn-warning').addClass('btn-success').html('<i class="fa fa-check" aria-hidden="true"></i> ' + loc);
                        $t.data('checked', 1);
                    } else {
                        //setting back to the default look
                        $t.removeClass('btn-warning').addClass('btn-default btn-outline').html(loc);
                        $t.data('checked', 0);
                    }
            });
           
        });

    </script>

</body>
</html>
