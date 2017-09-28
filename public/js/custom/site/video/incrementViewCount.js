var start = new Date().getTime();
var time = 0;
var elapsed = '0.0';
var firetime = '';

function videoMeta()
{
    var videoId = $(".video-js").attr('id');
    var player = videojs(videoId);

    var duration = player.duration();
    firetime = duration/2;

    console.log("duration: " + player.duration());
    console.log("current time: " + player.currentTime());
    console.log("firetime: " + firetime );
}

function timer()
{
    time += 100;

    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }

    //document.title = elapsed;

    if(elapsed > firetime){
        
        var videoid = $("#video_id").val();
        $.ajax({
            url : '/videocount',
            type: 'POST',
            data: {
                id: videoid,
            },
        }).done(function( data ){
            console.log('👀 This video is marked at watched!');
            console.log("🔺 view count: " + data);
            $('.viewcount').text(data + " views");

            //send to analytics
            var pathArray = window.location.pathname.split( '/' );
            loc = pathArray[2];
			loc_id = pathArray[4];
			var device = "Desktop";
			var videoId = loc_id; //same thing for this case
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

			trackEvent( device, "video_watch", videoId, localStorage.getItem('userStoreNumber'), loc, loc_id );

        });

        return false;
    }

    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(timer, (100 - diff));
}

window.setTimeout(videoMeta, 1000);
window.setTimeout(timer, 1100);
