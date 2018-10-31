@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')

@endsection


@section('content')
    
    
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">

           <div class="col-lg-12 animated fadeInRight">
               <div class="mail-box-header">
                    <span class="pull-left">
                        <h2>
                            Store Visit Reports
                        </h2>    
                    </span>
                   
                    
                    <span class="pull-right">
                        <a href="/manager/storevisitreport/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Report</a>
                    </span>

                </div>
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
                                                <td>{{$report->prettySubmitted}}</td>
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