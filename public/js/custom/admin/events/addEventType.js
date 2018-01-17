$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
	});

});
$(document).on('click','.eventtype-create',function(){

  	var hasError = false;

    var eventTypeName = $("#event_type").val();
    var bg = $("#background_colour").val();
    var fg = $("#foreground_colour").val();
    var banners = $("#banners").val();

    if(banners == null){
		swal("Oops!", "This we need a banner for this event type.", "error");
		hasError = true;
		$(window).scrollTop(0);
	}

    if(eventTypeName == '') {
		swal("Oops!", "This we need a name for this event type.", "error");
		hasError = true;
		$(window).scrollTop(0);
	}

	

	if(hasError == false) {
		$.ajax({
		    url: '/admin/eventtypes',
		    type: 'POST',
		    data: { event_type: eventTypeName, 
		    		background_colour: bg, 
		    		foreground_colour: fg, 
		    		banners: banners },
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
		        	$("#event_type").val(""); // empty the form
					swal("Nice!", "'" + eventTypeName +"' has been created", "success");
		        }

		    }
		});
	}

    return false;
});
