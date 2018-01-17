<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->





        <style>

/*        .video-js {padding-top: 56.25%}
        .vjs-fullscreen {padding-top: 0px}
*/

        body {
        background: none transparent;
        }

        /*body{ background: transparent url('/images/FFFFFF-0.0.png') top left repeat !important; } */
     /*   html{ background: transparent url('/images/FFFFFF-0.0.png') top left repeat !important; padding: 0; margin: 0; height: auto;}*/

        /*html{ background-color: lime; }*/

            video
            {
                width: 100%;
                height: auto;
                max-height: 100%;
                background: transparent url('/images/FFFFFF-0.0.png') top left repeat !important;
            }
        </style>

    </head>

    <body>
            <?php
                $video = $_REQUEST['v'];
                $token = md5( time() . time() );
            ?>

            <video autoplay="true" controls="true" id="current_video" width="auto" height="auto" class="video-js vjs-default-skin" data-setup="{}">
                <source src="/video/<?=$video?>?<?=$token?>" type="video/mp4">
                Your browser does not support the video tag or the file format of this video.
            </video>

    </body>

</html>
