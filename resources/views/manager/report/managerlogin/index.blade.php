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
    </style>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <h2>{{__("Manager Login Report")}}</h2>

            
        </div>   

    </div>

    <div class="tabs-container wrapper wrapper-content animated fadeInRight">
        
        <div class="tab-content">
            
            <div id="tab-toDate" class="tab-pane active">
                <div class="panel-body">
                    <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix" id="managerLogin">
                            
                                
                               <table class="table table-striped table-bordered datatable" >
                                    <thead>
                                        <tr role="row">
                                           <th>User</th>
                                           <th>Last Login</th>
                                           <th>Login Count since last week</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        @if(count($users)>0)
                                        @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->firstname}} {{$user->lastname}}
                                            </td>
                                            <td>
                                                {{$user->last_login}}
                                            </td>
                                            <td>
                                                {{$user->count}}
                                            </td>

                                        </tr>
                                        @endforeach
                                        @endif
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
    
    <script type="text/javascript" src="/js/plugins/js-xlsx-master/xlsx.js"></script>
    <script type="text/javascript" src="/js/plugins/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="/js/plugins/TableExport/tableexport.min.js"></script>

    <script>
        $("#managerLogin").tableExport({
            formats: [ 'csv'], 
        });
        $("table").DataTable();
    </script>  
@endsection