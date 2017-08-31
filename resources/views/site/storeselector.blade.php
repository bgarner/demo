
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{__("Store Selector")}}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">

    <style>
    #bannerSelect { text-transform: capitalize;}
    </style>
</head>

<body class="gray-bg">

                <center>
                <h1 class="animated fadeInDown" style="padding-top: 100px;">
                    <img src="/images/welcome-logo.png" />
                </h1>
                </center>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>



            </div>
            <h3>{{__("Welcome")}}</h3>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                	<labeL>{{__("Select Your Banner")}}</labeL>
                    <select id="bannerSelect" class="form-control">
							<option></option>
					</select>
                </div>
                <div class="form-group">
                	<labeL>{{__("Select Your Store")}}</labeL>
                    <select id="storeSelect" class="form-control">
					</select>
                </div>

            </form>

        </div>
    </div>



    <script type="text/javascript" src="/js/env.js"></script>
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/custom/site/storeselector/storeSelector.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
