    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css?<?=time()?>">

    <link rel="stylesheet" type="text/css" media="print" href="/css/print.css?<?=time()?>">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/sweetalert/sweetalert.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/fullcalendar/fullcalendar.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="print" href="/css/plugins/fullcalendar/fullcalendar.print.css?<?=time()?>">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/dataTables/datatables.min.css?<?=time()?>">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/videojs/video-js.css?<?=time()?>">
    <link href="/css/vendor/bootstrap-datetimepicker.min.css" rel="stylesheet">

    
    <style>
        .metismenu li.urgetnNoticeNav {
            background-color: #a50516;
            border: none !important; 
            color: white;
        }

        .metismenu li.urgetnNoticeNav a{
            border: none !important;
        }
        .animate-flicker {
            animation: fadeIn 1.3s infinite alternate;
        }

    </style>
    <style>
    .active-store{
        background-color: green;
        border-color: green;
        color: #ffffff;
    }
    </style>
    <script>

    </script>
