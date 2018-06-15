
@extends('manager.layouts.master')

@section('title', 'Dashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="/css/skins/manager/skin.css">

@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="mail-box-header">
            <h2>{{__("Featured Content")}}</h2>
        </div>
        <div class="mail-box">
             <div class="row">
                <div class="col-lg-12">
                    @if (count($features) > 0)
                    <div class="ibox float-e-margins">

                        <div class="ibox-content clearfix features">

                            @foreach($features as $feature)

                                    <div class="product-box">
                                        <a href="/manager/feature/show/{{$feature->id}}">
                                            <div class="image" style="background-image:url('/images/featured-covers/{{ $feature->thumbnail }}'); background-size: cover; background-position: 50%">

                                            </div>
                                            <div class="product-desc">
                                                <span class="product-price">
                                                {{ $feature->title }}
                                                </span>

                                            </div>
                                        </a>
                                    </div>

                            @endforeach

                        </div>

                    </div>
                    @endif
                </div>

            </div>
        </div>
       
    </div> <!-- class wrapper closes -->
    
@endsection

