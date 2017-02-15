<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{!! csrf_token() !!}"/>
        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

        <?php
        $dir = "../public/images/loginbackground/";
        $images = scandir($dir);
        $i = rand(2, sizeof($images)-1);
        ?>

        <!-- Theme style -->
        <style>
        .lockscreen {
          background: url('/images/loginbackground/<?php echo $images[$i]; ?>') repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        /* Remove the background from the body element */
        .lockscreen > body {
          background: transparent;
        }
        /* We will put the dynamically generated digital clock here */
        .lockscreen .headline {
          color: #fff;
          text-shadow: 1px 3px 5px rgba(0, 0, 0, 0.5);
          font-weight: 300;
          -webkit-font-smoothing: antialiased !important;
          opacity: 0.8;
          margin: 10px 0 30px 0;
          font-size: 90px;
        }
        @media screen and (max-width: 480px) {
          .lockscreen .headline {
            font-size: 60px;
            margin-bottom: 40px;
          }
        }
        /* User name [optional] */
        .lockscreen .lockscreen-name {
          text-align: center;
          font-weight: 600;
          font-size: 16px;
        }
        /* Will contain the image and the sign in form */
        .lockscreen-item {
          padding: 0;
          background: #fff;
          position: relative;
          -webkit-border-radius: 4px;
          -moz-border-radius: 4px;
          border-radius: 4px;
          margin: 10px auto;
          width: 290px;
        }
        .lockscreen-item:before,
        .lockscreen-item:after {
          display: table;
          content: " ";
        }
        .lockscreen-item:after {
          clear: both;
        }
        /* User image */
        .lockscreen-item > .lockscreen-image {
          position: absolute;
          left: -10px;
          top: -30px;
          background: #fff;
          padding: 10px;
          -webkit-border-radius: 50%;
          -moz-border-radius: 50%;
          border-radius: 50%;
          z-index: 10;
        }
        .lockscreen-item > .lockscreen-image > img {
          width: 70px;
          height: 70px;
          -webkit-border-radius: 50%;
          -moz-border-radius: 50%;
          border-radius: 50%;
        }
        /* Contains the password input and the login button */
        .lockscreen-item > .lockscreen-credentials {
          margin-left: 80px;
        }
        .lockscreen-item > .lockscreen-credentials input {
          border: 0 !important;
        }
        .lockscreen-item > .lockscreen-credentials .btn {
          background-color: #fff;
          border: 0;
        }
        /* Extra to give the user an option to navigate the website [optional]*/
        .lockscreen-link {
          margin-top: 30px;
          text-align: center;
        }

        /*
            Page: register and login
        */
        .form-box {
          width: 360px;
          margin: 90px auto 0 auto;
        }
        .form-box .header {
          -webkit-border-top-left-radius: 4px;
          -webkit-border-top-right-radius: 4px;
          -webkit-border-bottom-right-radius: 0;
          -webkit-border-bottom-left-radius: 0;
          -moz-border-radius-topleft: 4px;
          -moz-border-radius-topright: 4px;
          -moz-border-radius-bottomright: 0;
          -moz-border-radius-bottomleft: 0;
          border-top-left-radius: 4px;
          border-top-right-radius: 4px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
          /*background: #3d9970;*/
          background: #333;
          box-shadow: inset 0px -3px 0px rgba(0, 0, 0, 0.2);
          padding: 20px 10px;
          text-align: center;
          font-size: 26px;
          font-weight: 300;
          color: #fff;
        }
        .form-box .body,
        .form-box .footer {
          padding: 10px 20px;
          background: #fff;
          color: #444;
        }
        .form-box .body > .form-group,
        .form-box .footer > .form-group {
          margin-top: 20px;
        }
        .form-box .body > .form-group > input,
        .form-box .footer > .form-group > input {
          border: #fff;
        }
        .form-box .body > .btn,
        .form-box .footer > .btn {
          margin-bottom: 10px;
        }
        .form-box .footer {
          -webkit-border-top-left-radius: 0;
          -webkit-border-top-right-radius: 0;
          -webkit-border-bottom-right-radius: 4px;
          -webkit-border-bottom-left-radius: 4px;
          -moz-border-radius-topleft: 0;
          -moz-border-radius-topright: 0;
          -moz-border-radius-bottomright: 4px;
          -moz-border-radius-bottomleft: 4px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
          border-bottom-right-radius: 4px;
          border-bottom-left-radius: 4px;
        }
        @media (max-width: 767px) {
          .form-box {
            width: 90%;
          }
        }
        </style>



    </head>
    <body class="skin-black lockscreen" >

        <div class="form-box" id="login-box" style="box-shadow: 5px 5px 20px #333;">
            <div class="header"><img src="/images/fgl.png"><br />Sign In</div>
            <form class="m-t" role="form" action="index.html">
                <div class="body bg-gray">

                    <div class="form-group">
                        <!-- <input type="text" name="userid" class="form-control" placeholder="User ID"/> -->
                        <input id="email" name="email" class="form-control" type="text" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>

                </div>
                <div class="footer">
                    <!-- <a href="/dashboard" class="btn bg-olive btn-block">Sign me in</a> -->
                    <button class="btn bg-olive btn-block">Sign In</button>
                    <p><a href="#">I forgot my password</a></p>

                </div>
            </form>


        </div>
    <br />
    <br />
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
</html>

<!--
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" media="print" href="/css/print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" media="print" href="/css/plugins/fullcalendar/fullcalendar.print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css">

</head>




<body class="gray-bg">

    <img src="/images/welcome-logo.png" class="animated fadeInDown" style="display: block; width: 507px; margin: 0 auto; padding-top: 100px;">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            <h3>Manager Login</h3>

            <p></p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>


                <a href="#"><small>Forgot password?</small></a>

                <hr />

                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Request an account</a>
                <br /><br />
                <p><a href="/"><small>Back to the Portal</small></a></p>
            </form>

        </div>
    </div>

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html> -->
