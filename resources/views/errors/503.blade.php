<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{!! csrf_token() !!}"/>

        <title> Deployment in Progress... </title>

        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

        <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css">
    </head>

    <body class="gray-bg">

    <div class=" text-center animated fadeInDown" style="width: 90% !important; margin: 0 auto; padding-top: 50px;">


        {{-- <h1 style="font-size: 60px;">NOPE</h1>
        <h3 class="font-bold">This is what we call a 503 error, folks.</h3> --}}


<!--             <form class="form-inline m-t" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search for page">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form> -->

            <h1>Update in Progress</h1>

            <img src="/images/waiting.gif" />

            <br /><br />

            <p>This should only take a few more seconds, either refresh the page or wait and we will do it for you.</p>
            <h3>Refreshing the page in... </h3>
                <h1><div id="countdown"></div></h1>


    </div>


    <script>
    (function countdown(remaining) {
        if(remaining === 0)
            location.reload(true);
        document.getElementById('countdown').innerHTML = remaining;
        setTimeout(function(){ countdown(remaining - 1); }, 1000);
    })(30);
    </script>


    </body>

</html>
