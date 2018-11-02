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

                    <br>
                    <br>
                    
                </div>
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix">

                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th>Store Number</th>
                                           <th>Last Action On</th>
                                           <th></th>
                                           
                                       </tr>
                                   </thead>

                                   <tbody>
                                       @foreach($reports as $report)
                                       <tr>
                                            <td>
                                                {{$report->store_number}}
                                            </td>

                                            @if($report->is_draft)
                                                
                                                <td data-order="{{$report->updated_at}}">
                                                    <a href="storevisitreport/{{ $report->id }}/edit">Last Saved : {{$report->prettyUpdated}}</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger delete-report" data-report-id="{{$report->id}}" id="report{{$report->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            @else
                                                
                                                <td data-order="{{$report->submitted_at}}"><a  href="storevisitreport/{{ $report->id }}">Submitted : {{$report->prettySubmitted}}</a></td>
                                                <td></td>
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
<script>
$("table").dataTable({
    "order": [[ 1, "desc" ]]
});
</script>
<script type="text/javascript" src="/js/custom/manager/storevisitreport/deleteReport.js"></script>


@endsection