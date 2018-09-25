@extends('manager.layouts.master')

@section('title', 'Dirty Nodes')

@section('style')


@endsection


@section('content')

    <div class="wrapper wrapper-content">

       <div class="row">

           <div class="col-lg-12 animated fadeInRight">
               <div class="mail-box-header">
                   <h2>
                        Dirty Nodes        
                    </h2>
                </div>
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix">

                               <table class="table table-striped table-bordered datatable" id="community_donation_table" >
                                   <thead>
                                   <tr role="row">
                                       <th></th>
                                       <th>Cleaned this week</th>
                                       <th>Total Dirty Nodes Outstanding</th>
                                       <th>Oldest Dirty Node</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        @foreach($stores as $store)
                                        <tr>
                                        <td>{{$store}}</td>
                                        <td>
                                            @if(isset($cleanedLastWeek[$store]) )
                                             {{$cleanedLastWeek[$store]}}
                                            @endif
                                        </td>
                                        <td>
                                            @if( isset($outstanding[$store]) )
                                            {{$outstanding[$store]}}
                                            @endif
                                        </td>
                                        <td>
                                            @if( isset($oldestDirtyNode[$store]) )
                                            {{$oldestDirtyNode[$store]}}
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

@endsection        

@section('scripts')


@endsection