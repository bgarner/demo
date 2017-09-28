var start, time, elapsed, firetime, videoid;

function trackVideo(duration, video)
{
    
    videoid = video;
    //reset the timer and firetime
    start = new Date().getTime();
    time = 0;
    elapsed = '0.0';
    firetime = '';
    
    firetime = duration/2;    

    console.log("video id: " + videoid);
    console.log("duration: " + duration);
    console.log("timer: " + elapsed);
    console.log("firetime: " + firetime );

    //start the timer
    timer();
}


function timer()
{
    time += 100;

    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }

    document.title = elapsed;

    if(elapsed > firetime){
        fire();
        return false;
    }

    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(timer, (100 - diff));
}

function fire()
{
    $.ajax({
        url : '/videocount',
        type: 'POST',
        data: {
            id: videoid,
        },
    }).done(function( data ){
        console.log('👀 This video is marked at watched!');
        console.log("🔺 view count: " + data);

        //update the view count for the user
        $('.viewcount').text(data + " views");

        //send to analytics
        var pathArray = window.location.pathname.split( '/' );
        //loc = pathArray[2];
        loc_id = pathArray[4];
        var device = "Desktop";
        var videoId = videoid;
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
        var isiPhone = ua.indexOf("iphone") > -1;
        var isiPad = ua.indexOf("ipad") > -1;

        if(isAndroid) {
            var device = "Android";
        }

        if(isiPhone || isiPad){
            var device = "iOS";
        }

        if(isAndroid) {
            var device = "Android";
        }

        trackEvent( device, "video_watch", videoId, localStorage.getItem('userStoreNumber'), "playlist", loc_id );

    });
    
}