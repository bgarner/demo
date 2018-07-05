@extends('manager.layouts.master')
@section('title', 'Alerts' )

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-0">

        @include('manager.alerts.alertsidebar')

        </div>
        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 animated fadeInRight">
            <div class="mail-box-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            @if($title == "")
                                {{__("All Alerts")}} {{-- <small>({{ $alertCount }} unread)</small> --}}
                            @else
                                {{ $title }}
                            @endif
                        </h2>
                    </div>

                    <div class="col-lg-4 col-lg-offset-2" id="archive-switch">
                        <form class="form-inline" >
                            <div class="pull-right">

                                <small style="font-weight: bold; padding-right: 5px;">{{__("Show Archive")}}</small>

                                    <div class="switch pull-right">
                                        <div class="archive-onoffswitch onoffswitch">

                                            @if($archives)
                                                <input type="checkbox" checked="" class="onoffswitch-checkbox" id="archives" name="archives">
                                            @else
                                                <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                            @endif

                                            <label class="onoffswitch-label" for="archives">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div> <!-- row closes -->

            </div> <!-- mail-box header closes -->
            <div class="mail-box">
                <table class="table table-mail alert-table">
                    <thead>
                        <tr>

                            <th> {{ __("Type") }}</th>
                            <th> {{ __("Title") }} </th>
                            <!-- <th> Description </th> -->
                            <th> {{ __("Date") }} </th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($alerts as $alert)
                    

                    @if(isset($alert->archived))
                    <tr class="unread archived">
                    @else
                    <tr class="unread">
                    @endif
                        <td class="check-mail col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                            {{-- <i class="fa fa-bell-o"></i> --}}<span class="label">{{ $alert->alertTypeName }}</span>
                        </td>

                        <td class="mail-subject col-lg-7 col-md-6 col-sm-6 col-xs-6 ">{!! $alert->link_with_icon !!}</td>
                        <!-- <td class="mail-preview">{{ $alert->description }}</td> -->

                        <td class="mail-date col-lg-3 col-md-4 col-sm-4 col-xs-2">{{ $alert->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $alert->since }} ago)</small> --></td>
                    </tr>
                     @if(isset($alert->archived))
                    <tr class="store-row archived">
                    @else
                    <tr class="store-row">
                    @endif
                        <td></td>
                        <td colspan="3">
                            @if( isset($alert->stores) )
                            @foreach($alert->stores as $store)
                                @if(in_array($store, $alert->opened_by))
                                    <span class="badge active-store">{{$store}}</span>
                                    @else
                                    <span class="badge ">{{$store}}</span>
                                    @endif
                            @endforeach
                            
                            @elseif( $alert->all_stores == 1 )
                                <span class="badge">{{$alert->banner}}</span>
                            @endif
                        </td>
                    </tr>

                    @endforeach

                    </tbody>
                </table>


            </div> <!-- mail-box closes -->
        </div> 
    </div>
</div> <!-- class wrapper closes -->

@endsection