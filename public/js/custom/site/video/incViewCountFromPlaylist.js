var videosPlayedThisSession = [];

// $(document).ready(function() {

$('video').click('play', function(event) {
    var videoid = event.target.id;
    videoid = videoid.replace("video", "");
    trackVideo(videoid);
});

// $(".videoInPlaylist").click(function(event) {
//
//     var videoid = event.target.id;
//     videoid = videoid.replace("video", "");
//     trackVideo(videoid);
//     // var videoid = event.target.id;
//     // videoid = videoid.replace("video", "");
//     //
//     // var inArray = $.inArray( videoid, videosPlayedThisSession);
//     // console.log("in array?: " + inArray);
//     //
//     // if(inArray == -1){
//     //     console.log("first time played this session. added to array");
//     //     console.log(videosPlayedThisSession);
//     //     videosPlayedThisSession.push(videoid);
//     //
//     //     $.ajax({
//     //     	url : '/videocount',
//     //         type: 'POST',
//     //         data: {
//     //         	id: videoid,
//     //         },
//     //     }).done(function( data ){
//     //         console.log( '!!!  ' + videoid + ' has been tracked');
//     //     });
//     //
//     // } else {
//     //     console.log("video " + videoid + " has been played already. this is a play/pause.")
//     // }
//
// });

function trackVideo( videoid )
{
    //var videoid = event.target.id;
    //videoid = videoid.replace("video", "");

    var inArray = $.inArray( videoid, videosPlayedThisSession);
    console.log("in array?: " + inArray);

    if(inArray == -1){
        console.log("first time played this session. added to array");
        console.log(videosPlayedThisSession);
        videosPlayedThisSession.push(videoid);

        $.ajax({
            url : '/videocount',
            type: 'POST',
            data: {
                id: videoid,
            },
        }).done(function( data ){
            console.log( '!!!  ' + videoid + ' has been tracked');
        });

    } else {
        console.log("video " + videoid + " has been played already. this is a play/pause.")
    }
}

// });
