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
        @section('title', '503')
        @include('site.includes.head')
    </head>

    <body class="gray-bg">

    <div class=" text-center animated fadeInDown" style="width: 90% !important; margin: 0 auto; padding-top: 100px;">
        <h1 style="font-size: 60px;">NOPE</h1>
        <h3 class="font-bold">This is what we call a 503 error, folks.</h3>





        <div class="error-desc">
            <p>Service Unavailable... We could be experiencing high traffic at the momment.</p>
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
