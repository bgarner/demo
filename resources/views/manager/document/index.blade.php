@extends('manager.layouts.master')
@section('title', 'Library')

@section('style')
<link rel="stylesheet" type="text/css" href="/css/custom/tree.css">

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <h2>{{__("Library")}}</h2>

            <ol class="breadcrumb">
                <li><a href="/{{ Request::segment(1) }}">{{__("Home")}}</a></li>
                <li><a href="/{{ Request::segment(1) }}/document">{{__("Library")}}</a></li>
            </ol>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 col-lg-offset-2 document-archive" id="archive-switch">
            <form class="form-inline" >
                <div class="pull-right">

                    <small style="font-weight: bold; padding-right: 5px;">{{__("Show Archive")}}</small>

                        <div class="switch pull-right">
                            <div class="archive-onoffswitch onoffswitch">

                                <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">

                                <label class="onoffswitch-label" for="archives">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>

                </div>
            </form>
        </div>

    </div>

    <div class="tabs-container wrapper wrapper-content animated fadeInRight">
        <ul class="nav nav-tabs">
            @foreach($banners as $banner)
                <li id="tab-head-{{$banner->id}}" class=" tab-head @if($loop->first) active @endif" ><a data-toggle="tab" href="#tab-{{$banner->id}}" aria-expanded="true">{{ $banner->name }}</a></li>        
            @endforeach
            

        </ul>
        <div class="tab-content">
            @foreach($banners as $banner)
            <div id="tab-{{$banner->id}}" class="tab-pane @if($loop->first) active @endif">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="file-manager">
                                        
                                        <input type="text" hidden name="banner_id" value="{{$banner->id}}">
                                        <input type="text" hidden name="banner_name" value="{{$banner->name}}">
                                        <h5>{{ $banner->name }}</h5>

                                        <ul class="tree" id="navigation-structure">
                                            
                                            @foreach ($navigation["banner_". $banner->id] as $nav)

                                                @if ( $nav["is_child"] == 0)

                                                    @include('site.documents.foldernavigation-partial', ['navigation' => $navigation["banner_". $banner->id], 'currentnode' => $nav])

                                                @endif

                                            @endforeach
                                        </ul>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 animated fadeInRight">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="file-container-{{$banner->id}}" class="ibox hidden">
                                        <div class="ibox-title">
                                            <div id="folder-title-{{$banner->id}}" class="folder-title" data-folderId= "" data-isWeekFolder = "">
                                                <h2></h2>
                                            </div>
                                        </div>
                                        <div class="ibox-content">

                                            <input type="hidden" name="default_folder" value={{ $defaultFolder }}>
                                            
                                            @include('manager.document.document-table', ['banner'=> $banner])

                                        </div>
                                    </div>

                                    <div class="topLevelNavItems">

                                        <div style="font-weight: bold; color: #ddd; text-align: center; font-size: 30px; padding-top: 30px;">{{__("Select folders on the left")}}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> 

@endsection

<!-- <script src="/js/plugins/iCheck/icheck.min.js"></script> -->

@section('scripts')

<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/custom/tree.js?<?=time();?>"></script>
<script type="text/javascript" src="/js/custom/manager/document/getFolderDocument.js?<?=time();?>" ></script>
<script type="text/javascript" src="/js/custom/manager/document/breadcrumb.js?<?=time();?>" ></script>
<script type="text/javascript" src="/js/custom/manager/document/fileTable.js?<?=time();?>" ></script>
<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
<script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
<script src="/js/custom/manager/getArchivedContent.js?<?=time();?>"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

    var defaultFolderId = $("input[name='default_folder']").val();

    if (defaultFolderId) {
        var folder = $("#"+defaultFolderId);
        $("#"+defaultFolderId).parent().click();
        $.ajax({
            url : '/folder/' + defaultFolderId
        })
        .done(function(data){
            fillTable(data);
        });
    }

    $(document).ready(function(){
        checkDeepLink();
    });
</script>

@endsection
    