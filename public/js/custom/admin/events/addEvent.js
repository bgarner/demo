$(document).ready(function(){
	$("#allStores").click();	
});
$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen({width:'75%'});
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen({width:'75%'});
		
	}
});

$(".folder-checkbox").on('click', function(){
	if($(this).is(":checked")){
		$(this).attr('data-folderRoot', 'true')
		 $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked)
            .attr("disabled", true);

	}else{
		$(this).removeAttr('data-folderRoot')
	    $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', false)
            .attr("disabled", false);
	}	
});

$("#add-folders").click(function(){
	$("#folder-listing").modal('show');
});

$('#attach-selected-folders').on('click', function(){

	$("#folders-selected").empty();
	$("#folders-selected").append('<p>Folders attached :</p>');
	$('input[name^="package_folders"]').each(function(){

		console.log($(this));
		var attr = $(this).attr('data-folderRoot');
		
		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $("#folders-selected").append('<ul class="selected-folders" data-folderid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
		}
		
	});
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
    console.log(target_stores);
    var allStores  = $("allStores:checked").val();
    var attachments = [];
   	$(".selected-folders").each(function(){
		attachments.push($(this).attr('data-folderid'));
	});
 	
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
			        
			        $(".search-field").find('input').val('');
			        processStorePaste();
					// $("#storeSelect").chosen("destroy");
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