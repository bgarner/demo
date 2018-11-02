<!DOCTYPE html>
<html>

<head>
    @section('title', 'Store Visit Report')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
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

               <div class="col-lg-12 animated fadeInRight">
                    <div class="ibox">
                        <div class="ibox-title">
                            
                            <h1>
                                Store Visit Reports
                            </h1>    
                        </div>
                        <div class="ibox-content">
                           <div class="row">
                               <div class="col-md-12">

                                   <div class="table-responsive clearfix">

                                       <table class="table">
                                           <thead>
                                               <tr>
                                                   <th>Submitted On</th>
                                               </tr>
                                           </thead>

                                           <tbody>
                                               @foreach($reports as $report)
                                               <tr>
                                                        
                                                    <td data-order="{{$report->submitted_at}}"><a  href="storevisitreport/{{ $report->id }}"> {{$report->prettySubmitted}}</a>
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

        </div>

    </div>
    @include('site.includes.footer')

    @include('site.includes.scripts')

    @include('site.includes.bugreport')

    
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("table").dataTable({
            "order": [[ 1, "desc" ]]
        });

    </script>
    @include('site.includes.modal')
</body>
</html>
