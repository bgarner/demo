jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});

$( "#videolike" ).on( "click", function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : '/videolike',
	    type: 'POST',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

        $("#videolike").removeClass('btn-outline');
        $( "#videolike" ).html( '<i class="fa fa-thumbs-up"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videodislike").disable(true);

        $("#videodislike").removeClass('btn-danger');
        $("#videodislike").addClass('btn-default');
	});
});

$( "#videodislike" ).on( "click", function() {

	var videoid = $("#video_id").val();
	$.ajax({
		url : '/videodislike',
	    type: 'POST',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

        $("#videodislike").removeClass('btn-outline');
        $( "#videodislike" ).html( '<i class="fa fa-thumbs-down"></i> ' + data );

        $( "#videodislike" ).unbind();
        $( "#videolike" ).unbind();

        $("#videolike").disable(true);

        $("#videolike").removeClass('btn-primary');
        $("#videolike").addClass('btn-default');
	});
});






$( ".videodislikeplaylist" ).on( "click", function() {

	var videoid = $(this).attr("data-video-id");
	$.ajax({
		url : "/videodislike",
	    type: 'POST',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

		var likeButton = $(".videolikeplaylist[data-video-id='" + videoid + "']");
		var dislikeButton = $(".videodislikeplaylist[data-video-id='" + videoid + "']");

        dislikeButton.removeClass('btn-outline');
        dislikeButton.html( '<i class="fa fa-thumbs-down"></i> ' + data );

        dislikeButton.unbind();
		likeButton.unbind();

        likeButton.disable(true);

        likeButton.removeClass('btn-primary');
        likeButton.addClass('btn-default');
	});
});


$( ".videolikeplaylist" ).on( "click", function() {

	var videoid = $(this).attr("data-video-id");
	$.ajax({
		url : "/videolike",
	    type: 'POST',
	    data: {
	    	id: videoid,
	    },
	}).done(function( data ){

		var likeButton = $(".videolikeplaylist[data-video-id='" + videoid + "']");
		var dislikeButton = $(".videodislikeplaylist[data-video-id='" + videoid + "']");

        likeButton.removeClass('btn-outline');
        likeButton.html( '<i class="fa fa-thumbs-up"></i> ' + data );

        dislikeButton.unbind();
        likeButton.unbind();

        dislikeButton.disable(true);

        dislikeButton.removeClass('btn-danger');
        dislikeButton.addClass('btn-default');
	});
});
