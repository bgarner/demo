
@extends('manager.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="mail-box-header">
            <h2>Welcome {{Auth::user()->firstname}}!</h2>
        </div>
        <div class="mail-box">
            
        </div>
       
    </div> <!-- class wrapper closes -->
    
@endsection
