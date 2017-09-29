<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
    @include('site.includes.head')
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>{{__("Tasks")}}</h2>

            </div>
            <div class="col-lg-2">

            </div>
        </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            @include('site.tasks.tasksidebar')

            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8 animated fadeInRight">
                <!-- <div class="ibox float-e-margins"> -->
                    <div class="mail-box-header clearfix">
                        <h2>
                        {{--@if($title == "")
                                    {{__("All Tasks")}} {{ <small>({{ $taskCount }} incomplete)</small> }}
                                @else
                                    {{ $title }}
                                @endif--}}

                                {{__("All Tasks")}}
                        </h2>
                    </div>
                    <div class="mail-box clearfix">
                         <div id="task-container">
                        @include('site.tasks.task-list-partial')
                        </div>
                    </div>

                <!-- </div> -->
               
            </div>
        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')
    @include('site.includes.modal')
    <script type="text/javascript" src="/js/custom/site/tasks/completeTask.js"></script>

</body>
</html>

