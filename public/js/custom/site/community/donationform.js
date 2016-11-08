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
	// $("#donationsubmit").click(function(){
	// 	return false;
	// });
	
	$("#donationsubmit").click(function(){		


		$("input[type='text']").css ('borderColor', '#e5e6e7');
		$("select").css ('borderColor', '#e5e6e7');
		//$(".error").hide();
		//$("label").css('color', '#fff');

		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		var emp_name = $("#emp_name").val();
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

		var approval = $("#approval").is(':checked');


		
		//validation
		if(emp_name == '') {
			$("#emp_name").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		if(emp_number == '') {
			$("#emp_number").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		if(org_name == '') {
			$("#org_name").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}	

		if(pickup_name == '') {
			$("#pickup_name").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}	

		if(pickup_phone == '') {
			$("#pickup_phone").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}	

		if(donationtype == '') {
			$("#donationtype").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}							



		if(donationtype == "product"){

			if(product_name == '') {
				$("#product_name").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}

			if(style_number == '') {
				$("#style_number").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}

			if(upc == '') {
				$("#upc").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}

			if(product_value == '') {
				$("#product_value").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}										

		}


		if(donationtype == "giftcard"){

			if(gc_number == '') {
				$("#gc_number").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}

			if(gc_value == '') {
				$("#gc_value").css('borderColor', '#c00');
				hasError = true;
				$(window).scrollTop(0);
			}			
		}


		// if(emailVal == '') {
		// 	$("#label-email").css('color', '#c00')
		// 	hasError = true;
		// } else if(!emailReg.test(emailVal)) {	
		// 	$("#label-email").css('color', '#c00')
		// 	hasError = true;
		// }	

					
		if(hasError == false) {

			$.ajax({
			    url: '/savedonation',
			    type: 'POST',
			    data: {

			    	emp_name: emp_name,
					emp_number: emp_number,
					org_name: org_name,
					team_event_name: team_event_name,
					event_date: event_date,
					event_location: event_location,
					pickup_name: pickup_name,
					pickup_phone: pickup_phone,
					pickup_email: pickup_email,
					pickup_date: pickup_date,
					donationtype: donationtype,
					product_name: product_name,
					style_number: style_number,
					upc: upc,
					product_value: product_value,
					gc_number: gc_number,
					gc_value: gc_value,
					notes: notes,
					approval: approval
		
			    },
			    success: function(result) {
			        
					swal({
				        title: "Thanks!",
				        text: "",
				        type: "success"
				    });     

			    }
			    
			}).done(function(response){

				//clear the form
				$("#emp_name").val('');
				$("#emp_number").val('');
				
				$("#org_name").val('');
				$("#team_event_name").val('');
				$("#event_date").val('');
				$("#event_location").val('');

				$("#pickup_name").val('');
				$("#pickup_phone").val('');
				$("#pickup_email").val('');
				$("#pickup_date").val('');

				$("#donationtype").val('');

				$("#product_name").val('');
				$("#style_number").val('');
				$("#upc").val('');
				$("#product_value").val('');

				$("#gc_number").val('');
				$("#gc_value").val('');

				$("#notes").val('');

				$("#approval").attr('checked', false);

			}); 
				
		}

		//return false;
	});

});	