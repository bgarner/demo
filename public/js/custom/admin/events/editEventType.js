$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
	});

});

$(document).on('click','.eventtype-edit',function(){

  	var hasError = false;

  	var eventTypeID = $("#eventTypeID").val();
	var eventType = $("#event_type").val();
    var bg = $("#background_colour").val();
    var fg = $("#foreground_colour").val();
    var banners = $("#banners").val();

    if(banners == null){
		swal("Oops!", "This we need a banner for this event type.", "error");
		hasError = true;
		$(window).scrollTop(0);
	}

    if(eventType == '') {
		swal("Oops!", "This event type needs a name.", "error");
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/eventtypes/' + eventTypeID ,
		    type: 'PATCH',
		    data: {
		  		event_type: eventType,
                background_colour: bg,
                foreground_colour: fg,
                banners: banners
		    },
		    dataType : 'json',
		    success: function(data) {
		    	console.log(data);
		    	if(data != null && data.validation_result == 'false') {
		        	var errors = data.errors;
		        	console.log(errors);
		        	if(errors.hasOwnProperty("event_type")) {
		        		$.each(errors.event_type, function(index){
		        			$("#event_type").parent().append('<div class="req">' + errors.event_type[index]  + '</div>');
		        		});
		        	}
		        	if(errors.hasOwnProperty("banners")) {
		        		$.each(errors.banners, function(index){
		        			$("#banners").parent().append('<div class="req">' + errors.banners[index]  + '</div>');
		        		});
		        	}
		        }
		        else{
		      		swal("Nice!", "'" + eventType +"' has been updated", "success");
				}
		    }
		});
    }


    return false;
});
