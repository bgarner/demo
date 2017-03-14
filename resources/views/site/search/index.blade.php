<!DOCTYPE html>
<html>

<head>
    @section('title', 'Search: '. $query)
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>

    #footer{
        position: fixed;
        bottom: 0px;
    }

    </style>    
    
</head> 

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg clearfix">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="row">
                <div class="col-lg-8">
                <h2>Search results for: <span class="search-query">{{ $query }}</span></h2>
                </div>
               <div class="col-lg-2 col-lg-offset-2" >
                    <form class="form-inline" >
                        <div tyle="float:right">
                            <label>Archives</label>
                            
                                <div class="switch">
                                    <div class="onoffswitch">
                                        
                                        @if(isset($archives))
                                        <input type="checkbox" checked="" class="onoffswitch-checkbox" id="archives" name="archives">
                                        @else
                                        <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                        @endif
                                        <label class="archive-onoffswitch onoffswitch-label" for="archives">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                           
                        </div>
                    </form>
                </div>
<!--                 <ol class="breadcrumb">
                    <li>jdaf ja fl aslk salk adslkd aslkdsa lksad</li>
                </ol> -->
            </div>
            
        </div>            



            <div class="wrapper wrapper-content">

                <div class="row">


                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Documents <small>{{ count($docs) }} results</small></h2>
                        </div>

                        @if( count($docs) > 0)
                        <div class="mail-box">

                            <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                <thead>
                                    <tr> 
                                        <th> Title </th> 
                                        <!-- <th> Description </th>  -->
                                        <th>Folder</th>
                                        <th> Last Updated </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($docs as $doc)
                                    @if($doc->archived)
                                        <tr class="archived">
                                    @else
                                        <tr> 
                                    @endif
                                        <td class="mail-subject">{!! $doc->modalLink !!}</td> 
                                        <!-- <td>{{ $doc->description }}</td>  -->
                                        <td><a href="/{{ Request::segment(1) }}/document#!/{{ $doc->global_folder_id}}">{{ $doc->folder_name }}</a></td>
                                        <td>{{ $doc->since }} ago</td> 
                                        <td></td> 
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Alerts <small>{{ count($alerts) }} results</small></h2>
                        </div>


                        @if( count($alerts) > 0)
                        <div class="mail-box">

                            <table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid">
                                <thead>
                                    <tr> 
                                        <th> Title </th> 
<!--                                         <th> Description </th>  -->
                                        <th> Active Since </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($alerts as $alert)
                                    @if($alert->archived)
                                        <tr class="archived">
                                    @else
                                        <tr>
                                    @endif 
                                        <td class="mail-subject">{!! $alert->modalLink !!}</td> 
<!--                                         <td>{{ $alert->description }}</td>  -->
                                        <td>{{ $alert->since }} ago</td> 
                                        <td></td> 
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div>                 


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Folders <small>{{ count($folders) }} results</small></h2>
                        </div>
                        @if( count($folders) > 0)
                        <div class="mail-box">

                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Folder </th> 
                                        <th> Path </th> 
                                        <th> Last Updated </th> 
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($folders as $folder)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-folder-open"></i></td>
                                        <td class="mail-subject"><a href="/{{ Request::segment(1) }}/document#!/{{ $folder->globalId }}">{{ $folder->name }}</a></td>
                                        <td>{!! $folder->path !!}</td>                 
                                        <td class="mail-date">{{ $folder->lastActivity }} ago</td>
                                    </tr>                
                                @endforeach
                                                 
                                </tbody>
                            </table>


                        </div>
                        @endif
                    </div>

                </div>                
           

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Communications <small>{{ count($communications) }} results</small></h2>
                        </div>
                        @if( count($communications) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr> 
                                        <th></th>
                                        <th> Subject </th> 
                                        <th>  </th> 
                                        <th> Posted </th> 
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($communications as $comm)
                                    @if($comm->archived)
                                        <tr class="archived">
                                    @else    
                                        <tr>
                                    @endif
                                        <td class="check-mail"><i class="fa fa-envelope-o"></i></td>
                                        <td class="mail-subject"><a href="/{{ Request::segment(1) }}/communication/show/{{ $comm->communication_id }}">{{ $comm->subject }}</a></td>
                                        <td>{{ $comm->trunc }}</td>
                                        <td>{{ $comm->since }} ago</td>
                                    </tr>                
                                    @endforeach
                                                 
                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div> 

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Events <small>{{ count($events) }} results</small></h2>
                        </div>
                        @if( count($events) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr> 
                                        <th></th>
                                        <th> Title </th> 
                                        
                                        <th> Start </th> 
                                        <th> End </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($events as $e)
                                    @if($e->archived)
                                        <tr class="archived">
                                    @else    
                                        <tr>
                                    @endif
                                        <td class="check-mail"><i class="fa fa-calendar"></i></td>
                                        
                                        <td>{{ $e->title }}</td>
                                        <td>{{ $e->prettyDateStart }} </td>
                                        <td>{{ $e->prettyDateEnd }} </td>
                                    </tr>                
                                    @endforeach
                                                 
                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div> 

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Videos <small>{{ count($videos) }} results</small></h2>
                        </div>
                        @if( count($videos) > 0)
                        <div class="mail-box">


                            <table class="table table-hover table-mail">

                                <thead>
                                    <tr> 
                                        <th></th>
                                        <th> Title </th> 
                                        <th> Thumbnail </th>
                                        <th> Desctiption </th> 
                                        <th> Last Updated </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($videos as $v)
                                    <tr>
                                        <td class="check-mail"><i class="fa fa-film"></i></td>
                                        
                                        <td>{{ $v->title }}</td>
                                        <td><a href="/{{ Request::segment(1) }}/video/watch/{{$v->id}}"> <img src="/video/thumbs/{!! $v->thumbnail !!}"  height="75" width="125"></a></td>
                                        <td>{{ $v->description }} </td>
                                        <td>{{ $v->since }}</td>
                                    </tr>                
                                    @endforeach
                                                 
                                </tbody>
                            </table>

                        </div>
                        @endif
                    </div>

                </div> 

   

                            

                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')
    @include('site.includes.bugreport')
    @include('site.includes.modal')
    <script type="text/javascript" src="/js/custom/site/getArchivedContent.js"></script>
    <script type="text/javascript" src="/js/custom/site/highlightSearch.js"></script>


</body>
</html> 

