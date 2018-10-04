@extends('manager.layouts.master')
@section('title', 'Product Request Report' )

@section('style')
    <!-- <link rel="stylesheet" href="/css/plugins/TableExport/tableexport.min.css"> -->
    <style>
        .blank_row
        {
            height: 25px !important;
            background-color: #FFFFFF !important;
            border: 0 !important;
        }
        .table{
            margin-top: 10px;
        }
        .ibox{
            margin-top: 15px;
        }
        .filter-container{
            padding-bottom: 20px !important;
        }
        .current-filter{
            padding-top: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div >
            <h2>{{__("Product Request Report")}}</h2>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <div class="filter-container wrapper wrapper-content">
                <h3>{{__("Filters")}}</h3>    
                <div class="row">
                    <div class="form-group col-md-3 col-sm-3 ">
                        <label class="control-label">Department</label>
                        <div >
                            <select name="department" id="department" class="form-control input-sm">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group  col-md-3 col-sm-3">
                        <label class="control-label">Category</label>
                        <div>
                            <select name="category" id="category" class="form-control input-sm">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-sm-3">
                        <label class="control-label">Sub Category</label>
                        <div>

                            <select name="subcategory" id="subcategory" class="form-control input-sm">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-2">
                        <br>
                        <button class="btn btn-primary" id="filter_report"><i class="fa fa-check"></i> Filter</button>
                    </div>
                </div>
                <div class="current-filter"> <h4>Selected Filter :</h4>
                    <ol class="breadcrumb">
                        <li>No Filters</li>
                    </ol>
                </div>

            </div>        
            <div class="tabs-container wrapper wrapper-content animated fadeInRight">
                
                <ul class="nav nav-tabs">
                    
                    <li id="tab-head-1" class=" tab-head active" >
                        <a data-toggle="tab" href="#tab-toDate" aria-expanded="true">To Date
                        </a>
                    </li> 
                    <li id="tab-head-2" class=" tab-head" >
                        <a data-toggle="tab" href="#tab-lastWeek" aria-expanded="true">
                            Since Last Week
                        </a>
                    </li>        
                </ul>
                
                <div class="tab-content">
                    
                    <div id="tab-toDate" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                               <div class="col-md-12">

                                   <div class="table-responsive clearfix" id="toDateProductRequestReport">
                                    
                                        
                                       <table class="table table-striped table-bordered datatable" id="toDateTable" >
                                        <thead>
                                            <tr role="row">
                                               <th>Resolution Code</th>
                                               <th>Count</th>
                                               <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        {{-- @foreach($toDate as $bu=>$data)
                                            <tr class="blank_row">
                                                <th colspan="3">{{$bu}}</th>
                                            </tr>  
                                           
                                           <tbody>

                                                @foreach($data as $resolution_code_data)
                                                <tr>
                                                    <td>
                                                        {{$resolution_code_data['resolution_code']}}
                                                    </td>
                                                    <td>
                                                        {{$resolution_code_data['count']}}
                                                    </td>
                                                    <td>
                                                        {{$resolution_code_data['percentage']}}%
                                                    </td>

                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{$data[0]['total']}}</td>
                                                    <td></td>
                                                </tr>                                        
                                                
                                           </tbody>

                                       
                                       @endforeach--}}


                                       @foreach($toDate as $data)
                                            <tr>
                                                <td>{{$data->resolution_code}}</td>
                                                <td>{{$data->count}}</td>
                                                <td>{{$data->percentage}}%</td>
                                            </tr>
                                            
                                       @endforeach
                                       </table>
                                   </div>
                               </div>

                           </div>
                        </div>
                    </div>

                    <div id="tab-lastWeek" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                               <div class="col-md-12">

                                   <div class="table-responsive clearfix" id="lastWeekProductRequestReport">
                                    <span class="pull-right"> Since : {{$lastWeek}}</span>
                                    <table class="table table-striped table-bordered datatable" id="sinceLastWeekTable" >   
                                        <thead>
                                        
                                           <tr role="row">                                   
                                               <th>Resolution Code</th>
                                               <th>Count</th>
                                               <th>Percentage</th>
                                           </tr>
                                        </thead>
                                        {{--@foreach($sinceLastWeek as $bu=>$data)
                                        
                                        <tr class="blank_row">
                                            <th colspan="3">{{$bu}}</th>
                                        </tr> 
                                       
                                        <tbody>
                                            @foreach($data as $resolution_code_data)
                                            <tr>
                                                <td>
                                                    {{$resolution_code_data['resolution_code']}}
                                                </td>
                                                <td>
                                                    {{$resolution_code_data['count']}}
                                                </td>
                                                <td>
                                                    {{$resolution_code_data['percentage']}} %
                                                </td>

                                            </tr>
                                            @endforeach   
                                            <tr>
                                                <td>Total</td>
                                                <td>{{$data[0]['total']}}</td>
                                                <td></td>
                                            </tr>
                                                                                       
                                        </tbody>

                                       

                                        @endforeach--}}
                                        @foreach($sinceLastWeek as $data)
                                            <tr>
                                                <td>{{$data->resolution_code}}</td>
                                                <td>{{$data->count}}</td>
                                                <td>{{$data->percentage}} %</td>
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

        </div>

    </div>
@endsection
@section('scripts')
    
    <script type="text/javascript" src="/js/plugins/js-xlsx-master/xlsx.js"></script>
    <script type="text/javascript" src="/js/plugins/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="/js/plugins/TableExport/tableexport.min.js"></script>
    <script src="/js/custom/forms/ProductRequestFormOptions.js"></script>
    <script src="/js/custom/manager/reports/ProductRequestFormReport.js"></script>
    <script>
        $("#toDateProductRequestReport").tableExport({
            formats: [ 'csv'], 
        });
        $("#lastWeekProductRequestReport").tableExport({
            formats: ['csv'], 
        });

        
    </script>  
@endsection