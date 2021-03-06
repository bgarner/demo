@extends('manager.layouts.master')
@section('title', 'Communications' )

@section('style')
    
@endsection

@section('content')


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-0">

            @include('manager.communications.commsidebar')

            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>
                                @if($title == "")
                                    {{__("All Messages")}} {{-- <small>({{ $communicationCount }} unread)</small> --}}
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


                    <table class="table table-mail">
                        <tbody>

                        @foreach($communications as $communication)
                        <?php $tr_class="" ?>

                        @if($communication->archived)
                            <?php $tr_class .= " manager-archived"; ?>
                        @endif


                        <tr class= "{{ $tr_class }} comm-row" >
                            <td class="check-mail hidden-sm hidden-xs">
                                @if($communication->archived)
                                <i class="fa fa-archive"></i>
                                @else
                                <i class="fa fa-envelope"></i>
                                @endif
                            </td>

                            <td  class="mail-subject communication-name col-lg-4 col-md-4 col-sm-4 col-xs-5">

                                @if($communication->has_attachments == true)
                                    <i class="fa fa-paperclip"></i>
                                @endif
                                <a class="comm_category_link trackclick" data-comm-id="{{ $communication->id }}" href="communication/show/{{ $communication->id }}?">{{ $communication->subject }}</a>
                                <br />
                                <span class="label label-sm label-message-cat label-{!! $communication->label_colour !!}">{!! $communication->label_name !!}</span>
                            </td>


                            <td class="mail-preview col-lg-6 col-md-4 hidden-sm hidden-xs"><a href="communication/show/{{ $communication->id }}">{!! $communication->trunc !!}</a></td>

                            <td class="text-right mail-date col-lg-2 col-md-2 col-sm-4 col-xs-2">{{ $communication->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small> --></td>
                        </tr>
                        <tr class="{{ $tr_class }} store-row">
                            <td></td>
                            <td colspan="3">
                                @if( isset($communication->stores) )
                                
                                @foreach($communication->stores as $store)
                                    @if(in_array($store, $communication->opened_by))
                                    <span class="badge active-store">{{$store}}</span>
                                    @else
                                    <span class="badge ">{{$store}}</span>
                                    @endif
                                @endforeach
                                
                                @elseif( $communication->all_stores == 1 )
                                    <span class="badge">{{$communication->banner}}</span>
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