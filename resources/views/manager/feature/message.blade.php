    @extends('manager.layouts.master')
    
    @section('title', 'Feature: ' . $feature->title)
    
    @section('style')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/site/feature.css">
    <style>
    #page-wrapper{
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 1) 100%), url('/images/featured-backgrounds/{{ $feature->background_image }}') no-repeat 0px 50px;
        background-size: cover;
        overflow: hidden;
    }

    #footer{
        position: fixed;
        bottom: 0px;
    }

    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }

    #file-table tr td:last-child {
    white-space: nowrap;
    width: 1%
    }

    </style>

    @endsection


    @section('content')

        <div class="wrapper wrapper-content">

            <h1 style="color: #fff; font-size: 65px; text-transform: uppercase; font-family: GalaxiePolarisCondensed-Bold;text-shadow: 3px 3px 23px rgba(0, 0, 0, 1);padding-bottom: 10px;">{{ $feature->title }}
            </h1>

            <div class="row">
                <div class="col-lg-8">
                @if(isset($feature_documents) && count($feature_documents) > 0)
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2>{{__("Featured Documents")}}</h2>
                        </div>

                        <div class="ibox-content clearfix">

                            <table class="table tablesorter table-hover" id="file-table">
                                <thead>
                                    <tr>
                                        <th> {{__("Title")}} </th>
                                        <th> {{__("Added")}} </th>
                                    </tr>
                                </thead>

                                @foreach ($feature_documents as $document)

                                    <tr>
                                        <td> {!! $document->link_with_icon !!} </td>
                                        <td> {{ $document->prettyDate }} </td>
                                    </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                    @endif

                    @if(count($flyers) > 0)
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Flyer</h2>
                            </div>

                            <div class="ibox-content clearfix">

                                <table class="table tablesorter table-hover" id="file-table">
                                    <thead>
                                        <tr>
                                            <th> Title </th>
                                            <th> Uploaded On </th>
                                            <th> Available Until </th>
                                        </tr>
                                    </thead>

                                    @foreach ($flyers as $flyer)

                                        <tr>
                                            <td><a href="../../flyer/{{ $flyer->id }}">{{ $flyer->flyer_name }}</a>  </td>
                                            <td>{{ $flyer->pretty_start_date }}  </td>
                                            <td>{{ $flyer->pretty_end_date }}  </td>
                                        </tr>

                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h2>{{__("Additional Documents")}}</h2>
                                </div>

                                <div class="ibox-content clearfix">
                                    <div class="row">
                                        <div class="col-lg-4 package-listing">
                                        @foreach($feature_packages as $package)

                                            @include('site.feature.package-listing', ['package'=>$package])

                                        @endforeach
                                        </div>

                                        <div class="col-lg-8 package-document-container ">


                                            @foreach($feature_packages as $package)
                                                <div class="single-package-document-container hidden" data-packageid= {{$package->id}} >

                                                    <?php $package_document_listing = $package['details']['package_documents']; ?>

                                                    <div class="package-document-listing" data-packageid= {{$package->id}} >
                                                        <div class="package-name" data-packageid= {{$package->id}}><h3> <i class="fa fa-folder-open-o"></i> {{$package->package_screen_name}} </h3></div>
                                                        <div class="col-md-12">
                                                        <table class="table tablesorter tablesorter-default">
                                                        @if(count($package_document_listing)>0)
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__("Title")}}</th>
                                                                    <th>{{__("Added")}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                        @endif
                                                        @foreach ($package_document_listing as $document)


                                                            <tr>
                                                                <td><div class="package-doc">{!! $document->link_with_icon !!}</div></td>
                                                                <td>{!! $document->prettyDate !!} </td>
                                                            </tr>


                                                        @endforeach
                                                        </tbody>
                                                        </table>
                                                        </div>
                                                    </div>

                                                    <div class="package-folder-document-listing" data-packageid = {{$package->id}}>
                                                        <div class="folder-name" data-packageid= {{$package->id}}><h3></h3></div>
                                                        <div class="package-folder-documents col-md-12" data-packageid= {{$package->id}}>
                                                            <table class="table tablesorter tablesorter-default">

                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @if(isset($feature_communications) && count($feature_communications) > 0 )
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h2>{{ $feature->title }} {{__("Communications")}} </h2>
                                </div>

                                <div class="mail-box">
                                    <table class="table table-hover table-mail">
                                    <tbody>
                                        @foreach($feature_communications as $communication)

                                        <?php $tr_class="" ?>
                                        @if( $communication->is_read == 1)
                                            <?php $tr_class = "unread";?>
                                        @else
                                            <?php $tr_class = "unread"; ?>
                                        @endif

                                        <?php $icon_class="fa fa-envelope-o" ?>
                                        @if($communication->archived)
                                            <?php $tr_class .= " manager-archived"; ?>
                                        @endif

                                        <tr class= "{{ $tr_class }}" >
                                            <td class="check-mail">

                                                <i class="{{$icon_class}}"></i>
                                            </td>

                                            @if( $communication->communication_type_id == "1" ||  $communication->communication_type_id == "2" )
                                                <td class="mail-subject communication-name">
                                                    @if($communication->has_attachments == true)
                                                        <i class="fa fa-paperclip"></i>
                                                    @endif
                                                    <a class="comm_category_link trackclick" data-comm-id="{{ $communication->id }}" href="../../communication/show/{{ $communication->id }}?">{{ $communication->subject }}</a>
                                                </td>
                                            @else
                                                <td class="mail-subject communication-name">
                                                    @if($communication->has_attachments == true)
                                                        <i class="fa fa-paperclip"></i>
                                                    @endif
                                                    <a class="comm_category_link trackclick" data-comm-id="{{ $communication->id }}" href="../../communication/show/{{ $communication->id }}?">{{ $communication->subject }}</a> <span class="label label-sm label-{!! $communication->label_colour !!}">{!! $communication->label_name !!}</span></td>
                                            @endif

                                            <td class="mail-preview"><a href="../../communication/show/{{ $communication->id }}">{!! $communication->trunc !!}</a></td>
                                            <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                                            <td class="text-right mail-date">{{ $communication->prettyDate }}<!--  <small style="font-weight: normal;padding-left: 10px;">({{ $communication->since }} ago)</small> --></td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif

                </div>

                <div class="col-lg-4">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h2>Events</h2>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        @if(count($events)>0)
                                            @foreach($events as $event)
                                                <div class="feed-element">
                                                    <div class="media-body">
                                                        {{$event->title}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h2>Tasks</h2>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        @if(count($tasklists)>0)
                                            @foreach($tasklists as $tasklist)
                                                <div class="feed-element">
                                                    <div class="media-body">
                                                        {{$tasklist->title}}
                                                        <ul>
                                                        @foreach($tasklist->tasks as $task)
                                                            <li>{{$task->title}}</li>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <br class="clearfix" />
        </div>

    @endsection        

    @section('scripts')

    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script type="text/javascript" src="/js/custom/tree.js?<?=time();?>"></script>
    <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
    <script type="text/javascript" src="/js/custom/site/documents/fileTable.js?<?=time();?>"></script>
    <script type="text/javascript" src="/js/custom/manager/feature/showFeaturePackageDetails.js?<?=time();?>"></script>
    <script type="text/javascript">
        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});
    </script>

    @endsection