sendEvent = function(sel, step) {	
    $(sel).trigger('next.m.' + step);    
};


var validateStep1 = function(){
	var modal = $(".modal-body.step-1");
	var emp_name = modal.find("#emp_name").val();
	var emp_number = modal.find("#emp_number").val();
	var hasError = false;

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

	if(hasError){
		return false;
	}
	sendEvent("#newdonationmodal", 2);

}

var validateStep2 = function(){
	var modal = $(".modal-body.step-2");
	var org_name = modal.find("#org_name").val();
	var hasError = false;

	if(org_name == '') {
		$("#org_name").css('borderColor', '#c00');
		hasError = true;
		$(window).scrollTop(0);
	}

	if(hasError){
		return false;
	}
	sendEvent("#newdonationmodal", 3);

}

var validateStep3 = function(){
	var modal = $(".modal-body.step-3");
	var pickup_name = modal.find("#pickup_name").val();
	var pickup_phone = modal.find("#pickup_phone").val();
	var pickup_date = modal.find("#pickup_date").val();
	var hasError = false;

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

	if(pickup_date == '') {
		$("#pickup_date").css('borderColor', '#c00');
		hasError = true;
		$(window).scrollTop(0);
	}	

	if(hasError){
		return false;
	}
	sendEvent("#newdonationmodal", 4);

}

var validateStep4 = function(){

	var modal = $(".modal-body.step-4");
	var donationtype = modal.find("#donationtype").val();

	var product_name = modal.find("#product_name").val();
	var style_number = modal.find("#style_number").val();
	var upc = modal.find("#upc").val();
	var product_value = modal.find("#product_value").val();

	var gc_number = modal.find("#gc_number").val();
	var gc_value = modal.find("#gc_value").val();

	var approval = modal.find("#approval").is(':checked')?1:0;

	console.log(approval);
	
	var hasError = false;

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
			$("#gc_number").parent().css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		if(gc_value == '') {
			$("#gc_value").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}			
	
	}

	console.log(hasError);
	// if(( parseInt(gc_value) >100 || parseInt(product_value) >100 )&& approval == 0)
	// {
	// 	$("#approval").css('borderColor', '#c00');
	// 	hasError = true;
	// 	$(window).scrollTop(0);
	// }

	if(hasError){
		return false;
	}
	
	submitForm();

}



$('select').on('change', function() {

  switch(this.value){
  	case "giftcard":
  		$("#productfields").hide();
  		$("#giftcardfields").show();
  		break;

  	case "product":
  		$("#giftcardfields").hide();
  		$("#productfields").show();
  		break;

  	default:
  		$("#giftcardfields").hide();
  		$("#productfields").hide();
  		break;
  }

});

$("body").on('click', '#add-gift-card', function(){
	var index = $(".giftcard").length +1;
	var newGiftCard = '<div class="giftcard well" id="giftcard'+index+'">';
	newGiftCard += $("#giftcard1").html();
	newGiftCard += '</div>';

	$("#giftcardfields").append(newGiftCard);
});

$("body").on('click', '#add-product', function(){
	var index = $(".product").length +1;
	var newProduct = '<div class="product well" id="product'+index+'">';
	newProduct += $("#product1").html();
	newProduct += '</div>';

	$("#productfields").append(newProduct);
});


var submitForm = function(){

		$("input[type='text']").css ('borderColor', '#e5e6e7');
		$("select").css ('borderColor', '#e5e6e7');
		//$(".error").hide();
		//$("label").css('color', '#fff');

		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		var banner = localStorage.getItem('userBanner');
		var store_number = $("#bugreport_store_number").val();
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

		var productCards = $("#productfields .product");
		var products = [];
		$(productCards).each(function(index, value){
			
			var product_name = $(this).find("#product_name").val();
			var style_number = $(this).find("#style_number").val();
			var upc = $(this).find("#upc").val();
			var product_value = $(this).find("#product_value").val();
			var product = { 
							'product_name' : product_name, 
							'style_number': style_number, 
							'upc': upc, 
							'product_value':product_value  };
			products.push(product);


		});

		var giftCards = $("#giftcardfields .giftcard");
		var giftcards = [];
		$(giftCards).each(function(index, value){
			
			var gc_number = $(this).find("#gc_number").val();
			var gc_value = $(this).find("#gc_value").val();
			var giftcard = { 
							'gc_number' : gc_number, 
							'gc_value': gc_value, 
							};
			giftcards.push(giftcard);

		});

		var notes = $("#notes").val();

		var approval = $("#approval").is(':checked')?1:0;

		$.ajax({
		    url: '/savedonation',
		    type: 'POST',
		    data: {
		    	banner: banner,
		    	store_number: store_number,
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
				products: products,
				giftcards : giftcards,
				notes: notes,
				approval: approval
	
		    },
		    success: function(result) {
		        
				swal({
					title: "Thanks!", 
					text: "", 
					type: "success"},
					
					   function(){ 
					       location.reload();
					   }
				);   

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

	};