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
		$("label").css('color', '#fff');


// emp_name
// emp_number
// org_name
// team_event_name
// event_date
// event_location
// pickup_name
// pickup_phone
// pickup_email
// pickup_date
// donationtype
// product_name
// style_number
// upc
// product_value
// gc_number
// gc_value
// notes
// approval


		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var fnameVal = $("#firstname").val();
		var lnameVal = $("#lastname").val();
		var emailVal = $("#email").val();
		var phoneVal = $("#phone").val();
		var officeVal = $("#office").val();
		var dietVal = $("#diet").val();
//		var flightsVal = $("#flights").val();
//		var flightsVal = $('input[name=flights]:checked', '#regform').val()		
		var busVal = $('#bus').val();
		//var activityVal = $("#activity").val();		
		var activity1Val = $('input[name=day1]:checked', '#regform').val()
		var activity2Val = $('input[name=day2]:checked', '#regform').val()
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

			// $.post("sendEmail.php",
   // 				{ fname: fnameVal,
   // 				  lname: lnameVal, 
   // 				  email: emailVal,
   // 				  phone: phoneVal,
   // 				  office: officeVal,
   // 				  diet: dietVal,
   // 				  bus: busVal,
   // 				  activity_1: activity1Val,   				  
   // 				  activity_2: activity2Val

   // 				},
   // 					function(data){
			// 			$("#regform").slideUp("normal", function() {				  						
																					
			// 				$("#regform").before("<h2>Thank You</h2><br /><p>Your registration has been received!</p><br />");											
			// 			});
   // 					}
			// 	 );
		}			
		
		return false;
	});

});	