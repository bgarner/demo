$(document).ready(function(){
	$("#allStores").click();	
	console.log("1");

});
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


$( "#title" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

$( "#event_type" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

$( "#start" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

$( "#end" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

$( "#description" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

$( "#storeSelect" ).focus(function() {
	$('.event-create i').removeClass("fa-spinner faa-spin animated");
	$('.event-create i').addClass("fa-check");		        
    $('.event-create span').text(' Create New Event');
});

// $( "#title" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin animated");
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });

// $( "#event_type" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin animated");
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });

// $( "#start" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin animated");
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });

// $( "#end" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin anima
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });

// $( "#description" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin animated");
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });

// $( "#storeSelect" ).focus(function() {
// 	$('.event-create i').removeClass("fa-spinner faa-spin animated");
// 	$('.event-create i').addClass("fa-check");		        
//     $('.event-create span').text(' Create New Event');
// });


$(document).on('click','.event-create',function(){
  	
  	var hasError = false;

  	var eventBanner = $("#banner").val(); 
	var eventTitle = $("#title").val(); 
    var eventType = $("#event_type").val();
    var eventDescription = CKEDITOR.instances['description'].getData();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var tags = $('#tags').val();
    var target_stores  = $("#storeSelect").val();
    var allStores  = $("allStores:checked").val();
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

    	$('.event-create i').removeClass("fa-check");
    	$('.event-create i').addClass("fa-spinner faa-spin animated");
    	$('.event-create span').text(' Saving');    	

		$.ajax({
		    url: '/admin/calendar',
		    type: 'POST',
		    data: {
		    	banner: eventBanner,
		  		title: eventTitle,
		  		description: eventDescription,
		    	event_type: eventType,
		    	start: eventStart,
		    	end: eventEnd,
		    	target_stores : target_stores,
		    	attachments : attachments
		    },

		    dataType: 'json',
		    error: function(data) {
			    console.log(data.responseText);
			 },

		    success: function(data) {
		        console.log(data);
		        if(data != null && data.validation_result == 'false') {
		        	var errors = data.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("event_type")) {
			        	$.each(errors.title, function(index){
			        		$("#event_type").parent().append('<div class="req">' + errors.event_type[0]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("start")) {
			        	$.each(errors.title, function(index){
			        		$("#start").parent().parent().append('<div class="req">' + errors.start[0]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("end")) {
			        	$.each(errors.title, function(index){
			        		$("#end").parent().parent().append('<div class="req">' + errors.end[0]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[0]  + '</div>');
		        	}
		        }
		        else{
			        
			        $('#createNewEventForm')[0].reset(); // empty the form
			        CKEDITOR.instances['description'].setData('');
			        $('#datepicker').find('input').datepicker('setDate', null);
			        $("#allStores").click();

					$('.event-create i').removeClass("fa-spinner faa-spin animated");
	    			$('.event-create i').addClass("fa-check");		        
			        $('.event-create span').text(' Event Created!');		        

			        $(function(){
					   function revertButton(){
						   	$( ".event-create span" ).fadeOut( "fast", function() {
		    					$('.event-create span').text(' Create New Event');
		  					});
		  					$('.event-create span').fadeIn();
							
					   };
					   window.setTimeout( revertButton, 2000 ); // 2 seconds     	
		        	});
		        
		    	}
			}   	
    	});


    return false;
	}
});