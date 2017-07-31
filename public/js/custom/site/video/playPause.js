jQuery(document).on('click', 'video', function(){

	var videoId = $(".video-js").attr('id');
    var player = videojs(videoId);
    console.log(player.paused());
    if (player.paused()) {
        console.log("play!");
        player.play();
    } else {
        console.log("pause!");
        player.pause();
    }
});
