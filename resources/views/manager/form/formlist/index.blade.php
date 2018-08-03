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
                        Forms      
                    </h2>
                </div>
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <div class="table-responsive clearfix">

                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th>Form Name</th>
                                           <th>Description</th>
                                           <th>New</th>
                                           <th>In Progress</th>
                                       </tr>
                                   <thead>

                                   <tbody>
                                       @foreach($forms as $form)
                                       <tr>
                                           <td><a href="form/{{ $form->form_path }}">{{ $form->form_label }}</a></td>
                                           <td>{{ $form->description }}</td>
                                           <td>{{ $form->count_new }}</td>
                                           <td>{{ $form->count_in_progress }}</td>
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