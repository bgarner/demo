$('select').on('change', function() {
 // alert( this.value ); // or $(this).val()

  switch(this.value){
  	case "giftcard":
  		$("#prodcutfields").hide();
  		$("#giftcardfields").show();
  		break;

  	case "product":
  		$("#giftcardfields").hide();
  		$("#prodcutfields").show();
  		break;

  	default:
  		$("#giftcardfields").hide();
  		$("#prodcutfields").hide();
  		break;
  }

});


$(document).ready(function() {

	//form submission:
	$("#donationsubmit").click(function(){
		return false;
	});
	
	$("#donationsubmit").click(function(){					   				   
		$(".error").hide();
		//$("label").css('color', '#fff');

		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		var emp_name = $("#").val();
		var emp_number = $("#emp_number").val();
		
		var org_name = $("#org_name").val();
		var team_event_name = $("#team_event_name").val();
		var event_date = $("#event_date").val();
		var event_location = $("#event_location").val();

		var pickup_name = $("#pickup_name").val();
		var pickup_phone = $("#pickup_phone").val();
		var pickup_email = $("#pickup_email").val();
		var pickup_date = $("#pickup_date").val();

		var donationtype = $("#donationtype").val();

		var product_name = $("#product_name").val();
		var style_number = $("#style_number").val();
		var upc = $("#upc").val();
		var product_value = $("#product_value").val();

		var gc_number = $("#gc_number").val();
		var gc_value = $("#gc_value").val();

		var notes = $("#notes").val();

		var approval = $("#approval").val();

//		var flightsVal = $("#flights").val();
//		var flightsVal = $('input[name=flights]:checked', '#regform').val()		
		// var busVal = $('#bus').val();
		//var activityVal = $("#activity").val();		
		// var activity1Val = $('input[name=day1]:checked', '#regform').val()
		// var activity2Val = $('input[name=day2]:checked', '#regform').val()
		// var shirtVal = $("#shirtsize").val();
		// var jacketVal = $("#jacketsize").val();
		// var shoesVal = $("#shoesize").val();


		//validation
		if(fnameVal == '') {
			$("#label-first").css('color', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		if(lnameVal == '') {
			$("#label-last").css('color', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		if(emailVal == '') {
			$("#label-email").css('color', '#c00')
			hasError = true;
		} else if(!emailReg.test(emailVal)) {	
			$("#label-email").css('color', '#c00')
			hasError = true;
		}	

		if(phoneVal == '') {
			$("#label-phone").css('color', '#c00')
			hasError = true;
			$(window).scrollTop(0);
		}	

		if(officeVal == '') {
			$("#label-office").css('color', '#c00')
			hasError = true;
			$(window).scrollTop(0);
		}		
		
		if(busVal == '') {
			$("#label-bus").css('color', '#c00')
			hasError = true;
			$(window).scrollTop(0);
		}			

		if(shirtVal == '') {
			$("#label-shirt-size").css('color', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}				

		if(jacketVal == '') {
			$("#label-jacket-size").css('color', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}	

		if(shoesVal == '') {
			//$("#shoesize").after('<span class="error">Please choose a size.</span>');
			$("#label-shoe-size").css('color', '#c00');
			
			hasError = true;
			$(window).scrollTop(0);
		}	

					
		if(hasError == false) {

			alert('send the data');

			
			// $(this).hide();
			// $("#sendemail").append('<img style="height: 15px; width: 128px;" src="/images/ajax-loader.gif" alt="Sending" id="sending" />');

			$.post("/savedonation",
   				{
   				  fname: fnameVal,
   				  lname: lnameVal, 
   				  email: emailVal,
   				  phone: phoneVal,
   				  office: officeVal,
   				  diet: dietVal,
   				  bus: busVal,
   				  activity_1: activity1Val,   				  
   				  activity_2: activity2Val

   				},
   					function(data){
						$("#regform").slideUp("normal", function() {				  						
																					
							$("#regform").before("<h2>Thank You</h2><br /><p>Your registration has been received!</p><br />");											
						});
   					}
				 );
		}			
		
		return false;
	});

});	