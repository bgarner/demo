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
                        <h2>Product Request: {{ $formInstance->store_number }} submitted on {{ $formInstance->prettySubmitted }} <small>({{ $formInstance->sinceSubmitted }} ago)</small></h2>    
                    </h2>
                </div>
                <div class="mail-box">
                   <div class="row">
                       <div class="col-md-12">

                           <table class="table">
                            <tr>
                                <td colspan="3">
                                    Submitted by: {{ $formInstance->form_data['submitted_by'] }} - {{ $formInstance->form_data['submitted_by_position'] }} at {{ $formInstance->store_number }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>
                                                Request for <strong>{{ strtoupper($formInstance->form_data['requirement']) }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Brand:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['brand'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Description:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['description'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Size:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['size'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Style:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['styleNumber'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Quantity:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['quantity'] }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2"><strong>Classification:</strong></div>
                                        <div class="col-sm-8">{{ $formInstance->form_data['department']  }} <i class="fa fa-caret-right"></i> {{ $formInstance->form_data['category'] }} <i class="fa fa-caret-right"></i> {{ $formInstance->form_data['subcategory'] }} <i class="fa fa-caret-right"></i> {{ $formInstance->form_data['gender'] }}</div>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <p><strong>Comments:</strong></p>
                                    <p>
                                    {{ $formInstance->form_data['comments'] }}
                                    </p>
                                </td>
                            </tr>

                        </table>
                       </div>

                   </div>



               </div>
               <div id="logContainer">
                    @include('admin.form.partials.log')
                </div>

           </div>
       </div>
    </div>

@endsection        

@section('scripts')


@endsection