@extends('manager.layouts.master')

@section('title', 'Product Request Forms')

@section('style')


@endsection


@section('content')

    <div class="wrapper wrapper-content">

       <div class="row">

           <div class="col-lg-12 animated fadeInRight">
               <div class="mail-box-header">
                   <h2>
                        Product Request Forms      
                    </h2>
                </div>
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix">

                               <table class="table datatable">
                                   <thead>
                                       <th>Store</th>
                                       <th>Date Submitted</th>
                                       <th>Submitted By</th>
                                       <th>Request</th>
                                       <th>Status</th>
                                   </thead>
                                   <tbody>
                                       @foreach($forms as $form)

                                           <tr>
                                               <td>{{ $form->store_number }}</td>
                                               <td>{{$form->created_at}}</td>
                                               <td>{{$form->submitted_by}}</td>
                                               <td>
                                                <a href="{{\Request::url()}}/{{$form->id}}">{{$form->description}}</a>
                                                </td>
                                               <td>
                                                    @if(isset($form->lastFormAction))
                                                    {{$form->lastFormAction->log["status_store_name"]}} by {{$form->lastFormAction->log["user_name"]}} ( {{$form->lastFormAction->log["user_position"]}} )
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
    <script>
    $(".datatable").dataTable();
    </script>
@endsection