$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen();
		
	}
});

$(document).on('click','.event-update',function(){
  	
  	var hasError = false;

  	var eventID = $("#eventID").val(); 
	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = CKEDITOR.instances['description'].getData();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var target_stores  = $("#storeSelect").val();
	var allStores  = $("#allStores:checked").val();
	var attachments = $("#attachments").val();
	
    if(eventTitle == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	
	if(eventType == ''){
		swal("Oops!", "Event type missing", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(eventStart == '' || eventEnd == '') {
		swal("Oops!", "This event needs a start and end date.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	
	if( target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/calendar/' + eventID ,
		    type: 'PATCH',
		    data: {
		    	id: eventID,
		  		title: eventTitle,
		  		description: eventDescription,
		    	event_type: eventType,
		    	start: eventStart,
		    	end: eventEnd,
		    	target_stores : target_stores,
		  		allStores : allStores,
		  		attachments : attachments
		    },
		    success: function(result) {
		      //  $('#createNewEventForm')[0].reset(); // empty the form
				swal({title:"Nice!", text: "'" + eventTitle +"' has been updated", type: 'success'}, function(){
					window.location = '/admin/calendar';
				});
				
		    }
		});    	
    }


    return false;
});