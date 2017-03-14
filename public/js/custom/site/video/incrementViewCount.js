$( document ).ready(function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : '/videocount',
	    type: 'POST',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){
		console.log(data);
	});
});
