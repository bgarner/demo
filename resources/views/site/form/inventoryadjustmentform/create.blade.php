<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Request Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

    <div id="page-wrapper" class="gray-bg" >
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        
                        <h5>Inventory Adjustment Form</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>UPC</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class="inventory_adjustment_record" data-record-number="1">
                                    <td>
                                        <input type="text" class="form-control"  placeholder="UPC" name="upc[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  placeholder="Description" name="decription[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  placeholder="Price" name="price[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"  placeholder="Quantity" name="quantity[]">
                                    </td>
                                    <td>
                                        <span class="btn btn-primary" id="add_more_records"><i class="fa fa-plus"></i> Add More</span>
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a class="btn btn-white" href="/{{$storeNumber}}/form/inventoryadjustment"><i class="fa fa-close"></i> Cancel</a>
                        <button class="btn btn-primary" id="form_send"><i class="fa fa-check"></i> Save and Send</button>
                    </div>
                </div>


            </div>
        </div>


    </div><!-- wrapper closes -->


        @include('site.includes.footer')

        @include('site.includes.scripts')

        @include('site.includes.bugreport')
        
        <!-- <script src="/js/custom/forms/InventoryAdjustmentForm.js"></script> -->

        <script type="text/javascript">

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("body").on("click",  "#add_more_records", function(e){
                
                var record = $(this).closest(".inventory_adjustment_record");
                var counter = record.data('record-number');
                var increment = parseInt(counter + 1);
                var clone = record.clone().attr('data-record-number', increment);
                $(this).remove();
                record.parent().append(clone);
                
            });


            $("#form_send").click(function(){
                console.log($("input[name='upc']").val());
            });


        </script>
        @include('site.includes.modal')
    </body>
    </html>
