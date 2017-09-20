<!DOCTYPE html>
<html>

<head>
    @section('title', __('Community Fund'))
    @include('site.includes.head')
    <link rel="stylesheet" media="screen" href="/css/plugins/iCheck/custom.css">
    <link rel="stylesheet" media="screen" href="/css/custom/site/community/donations.css">
    {{-- <link rel="stylesheet" media="screen" href="/css/plugins/datapicker/datepicker3.css"> --}}
    <link rel="stylesheet" media="screen" href="/css/vendor/bootstrap-datetimepicker.min.css">
    <style>
    .ui-datepicker{z-index:9999 !important;}
    .req{ font-size: 10px; }
    .modal-body.step{
        padding: 10px;
    }
    .m-progress-bar {
    min-height: 1em;
    background: #c12d2d;
    width: 5%;
}
    </style>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>{{__("Community Fund")}}</h2>
            </div>
        </div>


        <div class="wrapper wrapper-content">
            <div class="row">

                <div class="col-lg-12 animated fadeInRight">
                    <div class="mail-box-header">
                        <div class="row">
                            <div class="col-md-12">

                            <h1 class="pull-left">{{__("Total Donations")}}: &nbsp;&nbsp;&nbsp; <strong>{{ $totalDonation }}</strong></h1>

                            <a href="#" class="pull-right btn btn-outline btn-primary dim" data-toggle="modal" data-target="#newdonationmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;{{__("New Donation")}}</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="table-responsive clearfix">

                                    <table class="table table-striped table-bordered datatable" id="community_donation_table" >
                                        <thead>
                                        <tr role="row">
                                            <th></th>
                                            <th>Date Submitted</th>
                                            <th>{{__("Organization Name")}}</th>
                                            <th >{{__("Event/Team Name")}}</th>
                                            <th>{{__("Receipt Date")}}</th>
                                            <th>{{__("Donation Type")}}</th>
                                            <th>{{__("Amount")}}</th>
                                            <th>{{__("DM Approval")}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                            @foreach($donations as $donation)
                                            <tr class="{{ $donation->evenodd }}" role="row">
                                                <td>{{$donation->id}}</td>
                                                <td data-order="{{$donation->created_at}}">{{$donation->pretty_created_at}}</td>
                                                <td class="">{{ $donation->item }} {{ $donation->recipient_organization }}</td>
                                                <td class="">{{ $donation->event_or_team_name }}</td>
                                                <td class="">{{ $donation->receipt_date }}</td>
                                                <td class="">{{ $donation->donation_type }}</td>
                                                <td class="">{{ $donation->amount }}</td>

                                                <td class="center">
                                                    @if( $donation->dm_approval == 1)
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                    @else
                                                         -
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
    @include('site.includes.donation-modal-copy')
    <script type="text/javascript" src="/js/plugins/multi-step-modal-master/multi-step-modal.js"></script>
    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    <script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/community/donationform.js"></script>

    <script>

        $(function () {
            $('#event_date').datetimepicker({
                format: "MM/DD/YYYY"
            });

            $('#pickup_date').datetimepicker({
                format: "MM/DD/YYYY"
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".datatable").dataTable(
            {
                "order": [[ 0, 'desc' ]],

                "columns": [
                    { "visible": false },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                  ],
                pageLength: 50,
                responsive: true,
                fixedHeader: true,
                info:     false,
                bPaginate: false,
            }
        );
        
        
    </script>

</body>
</html>
