<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('manager.includes.head')

</head>

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('manager.includes.nav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                @include('manager.includes.topbar')
            </div>


            <div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="mail-box-header">
                             <a href="/manager/urgentnotice"><i class="fa fa-chevron-left"></i> {{__("Back")}}</a>
                            <h1>
                                {{ $notice->title }}
                                 <span class="pull-right font-normal" style="font-size: 16px;">{{ $notice->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $notice->since }} {{__("ago")}})</small></span>
                            </h1>

                        </div>
                        <div class="mail-box">

                            <div class="mail-body">
                                {!! $notice->description !!}
                            </div>

                            @if(count($attached_folders) > 0)
                            <div class="mail-attachment">
                                <h3>
                                    <span><i class="fa fa-paperclip"></i> {{ count($attached_folders) }} {{__("folders")}}</span>
                                </h3>
                                @foreach($attached_folders as $folder)

                                        <div class="file-box">
                                            <div class="file">
                                                <a href="/{{ Request::segment(1) }}/document#!/{{ $folder->global_folder_id }}">

                                                    <div class="icon">
                                                        <i class="fa fa-folder-open"></i>
                                                    </div>

                                                    <div class="file-name">
                                                        <div style="font-size: 16px; padding-bottom: 10px;"> {{ $folder->name }}</div>

                                                        <small class="clearfix"><span class="text-muted pull-left">{{ $folder->prettyDate }}</span> <span class="text-muted pull-right">{{ $folder->since }} {{__("ago")}}</span></small>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>

                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                            @endif
                            @if(count($attached_documents) > 0)
                           <div class="mail-attachment">
                                <h3>
                                    <span><i class="fa fa-paperclip"></i> {{ count($attached_documents) }} {{__("documents")}}</span>
                                </h3>

                                <div class="attachment">

                                    @foreach($attached_documents as $doc)

                                        <div class="file-box">
                                            <div class="file">
                                                {!! $doc->anchor_only !!}

                                                    <div class="icon">
                                                        {!! $doc->icon !!}
                                                    </div>


                                                    <div class="file-name">
                                                        <div style="font-size: 16px; padding-bottom: 10px;"> {{ $doc->title }}</div>

                                                        <small class="clearfix"><span class="text-muted pull-left">{{ $doc->prettyDate }}</span> <span class="text-muted pull-right">{{ $doc->since }} {{__("ago")}}</span></small>

                                                    </div>
                                                

                                            </div>

                                        </div>

                                    @endforeach


                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div> <!-- class wrapper closes -->
        </div> <!-- page wrapper -->
    </div> <!-- wrapper -->


    @include('manager.includes.footer')

    @include('manager.includes.scripts')
    <!-- <script src="/js/custom/manager/getArchivedContent.js?<?=time();?>"></script> -->
    <script src="/js/plugins/iCheck/icheck.min.js"></script>


    @include('site.includes.modal')

</body>
</html>
