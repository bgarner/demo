
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

    <img src="/images/welcome-logo.png" class="animated fadeIn" style="display: block; width: 507px; margin: 0 auto; padding-top: 100px;">

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
            </form>
         
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
