@extends('manager.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-lg-12 animated fadeInRight">
                <div class="mail-box-header">

                    <h2>
                        {{__("Urgent Notices")}}
                    </h2>

                </div>
                <div class="mail-box">


                    <table class="table table-mail">
                    <tbody>
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th> {{__("Title")}}</th>
                                <th> {{__("Description")}} </th>
                                <th> {{__("Date")}} </th>
                            </tr>
                        </thead>


                        @foreach($urgentNotices as $notice)
                            <tr>
                                <td class="check-mail"><i class="fa fa-bolt"></i></td>
                                <td><a class="trackclick" data-urgentnotice-id="{{ $notice->id }}" href="/{{ Request::segment(1) }}/urgentnotice/{{ $notice->id }}">{{ $notice->title }}</td>
                                <td>{{ $notice->trunc }}</td>
                                <td class="mail-date">{{ $notice->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $notice->since }} {{__("ago")}})</small></td>
                            </tr>
                            <tr class=" store-row">
                                <td></td>
                                <td colspan="3">
                                    @if( isset($notice->stores) )
                                    @foreach($notice->stores as $store)
                                        @if(in_array($store, $notice->opened_by))
                                            <span class="badge active-store">{{$store}}</span>
                                        @else
                                            <span class="badge ">{{$store}}</span>
                                        @endif
                                    @endforeach
                                    
                                    @elseif( $notice->all_stores == 1 )
                                        <span class="badge">{{$notice->banner}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div> <!-- class wrapper closes -->
    
@endsection