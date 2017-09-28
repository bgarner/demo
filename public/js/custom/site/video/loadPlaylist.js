var videoId = $(".video-js").attr('id');
var player = videojs(videoId);
var videoList = JSON.parse($("#videoList").val());
player.playlist(videoList); //load the playlist into the video player
var video = videoList[0]; // load the first video

$(".video-details").find("#video-title").text(video.name);
$(".video-details").find("#video-views").text(video.views);
$(".video-details").find("#video-since").text(video.sinceCreated);
$(".video-details").find("#video-description").text(video.description);
//send the 'video load'
$(".video-details").find("#clicktrack_link").attr('data-video-id', video.id).trigger('click'); 
$("#video_id").val( video.id );

// Initialize the playlist-ui plugin with no option (i.e. the defaults).
player.playlistUi();
player.playlist.autoadvance(0); 
player.on('loadedmetadata', function() {
    var duration = player.duration();
    var index = player.playlist.currentItem();
    var video = videoList[index];
    trackVideo(duration, video.id); //start the timer to track the watch
});

player.on('playlistitem', function() {
  var index = player.playlist.currentItem();
  var duration = player.duration();
  var video = videoList[index];
  $(".video-details").find("#video-title").text(video.name);
  $(".video-details").find("#video-views").text(video.views);
  $(".video-details").find("#video-since").text(video.sinceCreated);
  $(".video-details").find("#video-description").text(video.description);
  //send the video load
  $(".video-details").find("#clicktrack_link").attr('data-video-id', video.id).trigger('click');
});