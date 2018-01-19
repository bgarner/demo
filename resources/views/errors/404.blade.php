<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <head>
        <?php 
        $skin=""; 
        $dir = "../public/images/bloopers/";
        $images = scandir($dir);
        $i = rand(2, sizeof($images)-1);
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{!! csrf_token() !!}"/>

        <title> Whoops...Not Found </title>

        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

        <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css">
        <style type="text/css">
            body{background-color: #fff !important;}
        </style>
    </head> 

    <body class="gray-bg">

    <div class=" text-center animated fadeInDown" style="width: 90% !important; margin: 0 auto; padding-top: 100px;">
        <h1 style="font-size: 60px;">NOPE</h1>
        <h3 class="font-bold">This is what we call a 404 error, folks.</h3>

        



        <div class="error-desc">
            <p>You've made a typo or we did. <br />Either way, this is a <strong>fail</strong>.</p>
            <img src="/images/bloopers/<?php echo $images[$i]; ?>" alt="" />
        </div>

<!--             <form class="form-inline m-t" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search for page">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form> -->
        
        
            <h2>We Suggest...</h2>
            <p>
            <a href="/">Going to the home page</a><br />
            <a href="#" onclick="history.go(-1);">Going back to the page you just came from</a>
        </p>

    </div>



    
    </body>

</html>