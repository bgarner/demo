$(function () {
    $('#event_date').datetimepicker({
        format: "MM/DD/YYYY"
    });

    $('#pickup_date').datetimepicker({
        format: "MM/DD/YYYY"
    });

    var donationTable = $(".datatable").DataTable(
    {
        "order": [[ 0, 'desc' ]],
        "columns": [
            { "visible": false },
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            { "visible": false },
            { "visible": false }
          ],
        "pageLength"  : 50,
        "responsive"  : true,
        "fixedHeader" : true,
        "info"        : false,
        "bPaginate"   : false,
    }
    );
    donationTable.column( 8 ).visible( false );

    $('.datatable tbody').on('click', 'tr.details-control', function () {
            var tr = $(this);
            var row = donationTable.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
    } );
    function format ( d ) {

            var details = JSON.parse(d[8]);
            var returnString = '<table class="table "><thead><tr>'+
                                '<td colspan="2" class="donationProduct">Product</td>'+
                                '<td colspan="2">Style Number/Giftcard Number</td>'+
                                '<td colspan="2">Value</td>'+
                                '</tr></thead><tbody>';
            $(details).each(function(index, value){
                returnString += '<tr>'+
                    '<td colspan="2">'+value.description.toUpperCase()+'</td>'+
                    '<td colspan="2">'+value.style_number+'</td>'+
                    '<td colspan="2">'+value.value+'</td>'+
                    '</tr>';
            });

            returnString += '</tbody></table>';
            if(d[9] != ''){
            	returnString += '<div class="well"><b>Notes: </b>'+ d[9] +'</div>';	
            }
            
            return returnString;
            
    }
});
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
	var sport_category = modal.find("#sport_category").val();
	var hasError = false;

	if(org_name == '') {
		$("#org_name").css('borderColor', '#c00');
		hasError = true;
		$(window).scrollTop(0);
	}

	if(sport_category == '' || !sport_category ) {
		$("#sport_category").css('borderColor', '#c00');
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

	var gc_number_1 = modal.find("#gc_number_1").val();
	var gc_number_2 = modal.find("#gc_number_2").val();
	var gc_number_3 = modal.find("#gc_number_3").val();
	var gc_number_4 = modal.find("#gc_number_4").val();
	var gc_value = modal.find("#gc_value").val();

	var approval = modal.find("#approval").is(':checked')?1:0;
	
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

		var isnumSN = /^\d+$/.test(style_number);
		if(!isnumSN){
			alert("Please enter 1 style at a time. Also, check that there are no letters or spaces in your Style Number. If there are multiple items, click the '+ Product' link above to add another product.");
			$("#style_number").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		
		if(upc == '') {
			$("#upc").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		var isnumUPC = /^\d+$/.test(upc);
		if(!isnumUPC){
			alert("Please enter 1 UPC at a time. Also, check that there are no letters or spaces in your UPC. If there are multiple items, click the '+ Product' link above to add another product.");
			$("#style_number").css('borderColor', '#c00');
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
		if(gc_number_1 == '' || gc_number_2 == '' || gc_number_3 == ''|| gc_number_4 == '') {
			$("#gc_number").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}

		var gc_number = "" + gc_number_1 + gc_number_2 + gc_number_3 + gc_number_4;
		console.log("gc_number: " + gc_number);
		var isnumGC = /^\d+$/.test(gc_number);
		if(!isnumGC){
			alert("Please double check your Gift Card number to be sure there are no numbers, spaces or letters. If you need to add another card, click the '+ Gift Card' link.");
			$("#style_number").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}		

		if(gc_value == '') {
			$("#gc_value").css('borderColor', '#c00');
			hasError = true;
			$(window).scrollTop(0);
		}			
	
	}

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

		// this.disabled=true;
		// this.value='Submitting...';
		//$(this).find(':input[type=submit]').prop('disabled', true);
		$('.final-submit').prop('disabled', true);
		$('.final-submit').html('Submitting...');

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
		var sport_category = $("#sport_category").val();
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

			if(product_name && product_name !=""){
				products.push(product);	
			}
			


		});

		var giftCards = $("#giftcardfields .giftcard");
		var giftcards = [];
		$(giftCards).each(function(index, value){
			
			var gc_number_1 = $(this).find("#gc_number_1").val();
			var gc_number_2 = $(this).find("#gc_number_2").val();
			var gc_number_3 = $(this).find("#gc_number_3").val();
			var gc_number_4 = $(this).find("#gc_number_4").val();

			var gc_number = gc_number_1 + gc_number_2 + gc_number_3 + gc_number_4;
			var gc_value = $(this).find("#gc_value").val();
			var giftcard = { 
							'gc_number' : gc_number, 
							'gc_value': gc_value, 
							};
			if(gc_number){
				console.log("gc " + gc_number);
				giftcards.push(giftcard);
			}
			

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
				sport_category: sport_category,
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
		        this.disabled=false;
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
			$("#sport_category").val('');
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