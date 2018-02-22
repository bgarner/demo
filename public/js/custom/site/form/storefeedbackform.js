$(document).ready(function(){

	console.log('done');
	if($("#formdata").length){

		
		var formData = JSON.parse($("#formdata").val());
		console.log(formData);
		$("#department").val(formData.department);	
		$("#category").val(formData.category);	
		$("#subcategory").val(formData.subcategory);	
		$("#requirement").val(formData.requirement);	
		$("#brand").val(formData.brand);	
		$("#styleNumber").val(formData.styleNumber);	
		$("#size").val(formData.size);
		$("#quantity").val(formData.quantity);
		$("#comments").val(formData.comments);
		$("#description").val(formData.description);


	}
	

	$("#department").on('change', function(){
		var dept = $("#department").val();
	});



	$("#form_send").click(function(){
		
		var department  = $("#department").val();
		var category    = $("#category").val();
		var subcategory = $("#subcategory").val();
		var requirement = $("#requirement").val();
		var brand       = $("#brand").val();
		var styleNumber = $("#styleNumber").val();
		var size        = $("#size").val();
		var quantity    = $("#quantity").val();
		var description = $("#description").val();
		var comments	= $("#comments").val();
		var storeNumber = localStorage.getItem('userStoreNumber');
	  	var hasError 	= false;

	    if(department == '') {
			swal("Oops!", "Department cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}

		if(category == '') {
			swal("Oops!", "Category cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(subcategory == '') {
			swal("Oops!", "Subcategory cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(requirement == '') {
			swal("Oops!", "Requirement cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(brand == '') {
			swal("Oops!", "Brand cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(styleNumber == '') {
			swal("Oops!", "Style Number cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(size == '') {
			swal("Oops!", "Size cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(quantity == '') {
			swal("Oops!", "Quantity cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}


	    if(hasError == false) {


			$.ajax({
			    url: "/" + storeNumber + '/form/storefeedbackform',
			    type: 'POST',
			    data: {
			    	department : department,
					category : category,
					subcategory : subcategory,
					requirement : requirement,
					brand : brand,
					styleNumber : styleNumber,
					size : size,
					quantity : quantity,
					description : description,
					comments : comments,
					storeNumber : storeNumber
			    },

			    dataType: 'json',
			    error: function(data) {
				    console.log(data.responseText);
				 },

			    success: function(data) {
			        console.log(data);
			   //      if(data != null && data.validation_result == 'false') {
			   //      	var errors = data.errors;
			   //      	if(errors.hasOwnProperty("title")) {
			   //      		$.each(errors.title, function(index){
			   //      			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');
			   //      		});
			   //      	}
			   //      	if(errors.hasOwnProperty("event_type")) {
				  //       	$.each(errors.title, function(index){
				  //       		$("#event_type").parent().append('<div class="req">' + errors.event_type[0]  + '</div>');
				  //       	});
				  //       }
				  //       if(errors.hasOwnProperty("start")) {
				  //       	$.each(errors.title, function(index){
				  //       		$("#start").parent().parent().append('<div class="req">' + errors.start[0]  + '</div>');
				  //       	});
				  //       }
				  //       if(errors.hasOwnProperty("end")) {
				  //       	$.each(errors.title, function(index){
				  //       		$("#end").parent().parent().append('<div class="req">' + errors.end[0]  + '</div>');
				  //       	});
				  //       }
				  //       if(errors.hasOwnProperty("target_stores")) {
			   //      		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[0]  + '</div>');
			   //      	}
			   //      }
			   //      else{

				  //       $('#createNewEventForm')[0].reset(); // empty the form
				  //       CKEDITOR.instances['description'].setData('');
				  //       $('#datepicker').find('input').datepicker('setDate', null);

				  //       $(".search-field").find('input').val('');
				  //       processStorePaste();
						// // $("#storeSelect").chosen("destroy");
				  //       $("#allStores").click();

						// $('.event-create i').removeClass("fa-spinner faa-spin animated");
		    // 			$('.event-create i').addClass("fa-check");
				  //       $('.event-create span').text(' Event Created!');

				  //       $(function(){
						//    function revertButton(){
						// 	   	$( ".event-create span" ).fadeOut( "fast", function() {
			   //  					$('.event-create span').text(' Create New Event');
			  	// 				});
			  	// 				$('.event-create span').fadeIn();

						//    };
						//    window.setTimeout( revertButton, 2000 ); // 2 seconds
			   //      	});

			   //  	}
				}
	    	});


	    return false;
		}
	});

});