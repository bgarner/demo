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


    <div class="wrapper wrapper-content">
        <div class="row" id="task-container">
            @include('site.tasks.task-list-partial')
        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')
    @include('site.includes.modal')
    <script type="text/javascript" src="/js/custom/site/tasks/completeTask.js?<?=time();?>"></script>

</body>
</html>

