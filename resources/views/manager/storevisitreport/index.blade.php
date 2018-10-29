@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')

@endsection


@section('content')
    
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <h2>{{__("Store Visit Report")}}</h2>

        </div>

    </div>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">

           <div class="col-lg-12 animated fadeInRight">
               <!-- <div class="mail-box-header">
                   <h2>
                        Store Visit Reports
                    </h2>
                </div> -->
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix">

                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th>Store Number</th>
                                           <th>Submitted At</th>
                                           <th></th>
                                           
                                       </tr>
                                   <thead>

                                   <tbody>
                                       @foreach($reports as $report)
                                       <tr>
                                            <td>
                                                {{$report->store_number}}
                                            </td>

                                            @if($report->is_draft)
                                                <td></td>
                                                <td>
                                                    <a href="storevisitreport/{{ $report->id }}/edit">Edit</a>
                                                    <a href="storevisitreport/{{ $report->id }}/">Delete</a>
                                                </td>
                                            @else
                                                <td>{{$report->submitted_at}}</td>
                                                <td><a href="storevisitreport/{{ $report->id }}">View</a></td>
                                            @endif
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

@endsection        

@section('scripts')




@endsection