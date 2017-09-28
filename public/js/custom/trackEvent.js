var pathArray = window.location.pathname.split( '/' );

$("body").on("click", ".trackclick", function(e){
// $( "[data-res-id]" ).live( "click", function () {
	var device = "Desktop";

	fileId = $(this).attr("data-res-id");
	videoId = $(this).attr("data-video-id");
	commId = $(this).attr("data-comm-id");
	flyerId = $(this).attr("data-flyer-id");
	urgentnoticeId = $(this).attr("data-urgentnotice-id");
	externalUrlId = $(this).attr("data-ext-url");
	playListId = $(this).attr("data-playlist-id");

	loc = pathArray[2];
	loc_id = pathArray[4];

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

	if(typeof loc == "undefined"){
		loc = "dashboard";
	}

	if(typeof loc_id == "undefined"){
		loc_id = 0;
	}

	if( loc == "document"){
		loc = "library";
	}

	//communication
	if(typeof commId != "undefined" ){
		trackEvent( device, "communication", commId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//urgent notice
	if(typeof urgentnoticeId != "undefined" ){
		trackEvent( device, "urgentnotice", urgentnoticeId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//external url
	if(typeof externalUrlId != "undefined"){
		trackEvent( device, "external_url", externalUrlId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	//play list
	if(typeof playListId != "undefined"){
		trackEvent( device, "playlist", playListId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	if(typeof videoId != "undefined"){
		trackEvent( device, "video", videoId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}

	if(typeof flyerId != "undefined"){
		trackEvent( device, "flyer", flyerId, localStorage.getItem('userStoreNumber'), loc, loc_id );
		return;
	}



	trackEvent( device, "file", fileId, localStorage.getItem('userStoreNumber'), loc, loc_id );

});

function trackEvent( device, type, resource, store, location, location_id)
{
	console.log('%cTrack an Event \n~~~~~~~~~~~~~~~~~~~'+
		        ' \n📱 Device: ' + device + 
		        ' \n✅ Type: ' + type + 
		        ' \n✅ Resource: ' + resource + 
		        ' \n✅ Store: ' + store +
		        ' \n✅ Location: ' + location + 
		        ' \n✅ Location ID: ' + location_id + 
		        ' \n🚀 Sent the event!', 
		        'background: #fff; color: #558ada; display: block; padding: 5px; line-height: 20px; 200px;');


	$.ajax({
	    url: '/clicktrack',
	    type: 'POST',
	    data: {
			device: device,
	  		type: type,
	  		resource_id: resource,
	  		store_number: store,
	  		location: location,
	  		location_id: location_id
	    },
	    success: function(result) {
	      console.log('%c🎈 Event has been recorded', 'background: #fff; color: #0c0; padding: 5px; position: relative; top: 15px; line-height: 20px;');
	    }

	});
	// .done(function(response){

	// });
}
