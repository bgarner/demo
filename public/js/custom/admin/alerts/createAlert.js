$(document).ready(function(){
	if($("#allStores").prop('checked')) {
		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
	}
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


$(document).on('click','.alert-create',function(){
  	
  	var hasError = false;
 	
 	var document_id = $("#documentID").val();
	var title = $("#title").val();
	var description = $("#description").val();
	var document_start = $("#document_start").val();
	var document_end = $("#document_end").val();

	var is_alert = 0;
	if ($("#is_alert").prop("checked")){
		is_alert = 1;	
	}
	var alert_type_id = $("#alert_type").val();
	
	// var start = $("#start").val();
	// var end = $("#end").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var allStores = $("#allStores:checked").val()
	 
	console.log('title : ' + title);
	console.log('description : ' + description);
	console.log('is_alert : ' + is_alert); 
	console.log('alert_type : '+ alert_type_id);
	// console.log('start : ' + start);
	// console.log('end : ' + end);
	console.log('target_stores : ' + target_stores);
	console.log('banner_id : ' + banner_id);
	console.log('all stores : ' + allStores);

    if(title == '') {
		swal("Oops!", "Title required for this document.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(document_start == '') {
			swal("Oops!", "Start date required for document", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
	if(target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores missing", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(is_alert == 1){
		if(alert_type_id == '' ) {
			swal("Oops!", "Alert type missing", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		
		// if(start == '' || end == '' ) {
		// 	swal("Oops!", "Start and End dates required for alert", "error"); 
		// 	hasError = true;
		// 	$(window).scrollTop(0);
		// 	return false;
		// }
		
	} 

	console.log(target_stores);
    if(hasError == false) {

    	$('.alert-create i').removeClass("fa-check");
    	$('.alert-create i').addClass("fa-spinner faa-spin animated");
    	$('.alert-create span').text(' Saving');

		$.ajax({
		    url: '/admin/document/' + document_id ,
		    type: 'PATCH',
		    data: {
		  		title : title,
		  		description: description,
		  		is_alert : is_alert,
		  		alert_type_id : alert_type_id,
		  		// start : start,
		  		// end: end,
		  		banner_id : banner_id,
		  		stores : target_stores,
		  		document_start : document_start,
		  		document_end : document_end,
		  		allStores : allStores

		  		
		    },
		    success: function(result) {
//		        console.log(result);
				$('.alert-create i').removeClass("fa-spinner faa-spin animated");
    			$('.alert-create i').addClass("fa-check");		        
		        $('.alert-create span').text(' Saved!');

		        $(function(){
				   function revertButton(){
				   	$('.alert-create span').fadeOut( "fast", function() {
	    				$('.alert-create span').text(' Save changes');
	  				});
				   	 
				      $('.alert-create span').fadeIn();
				   };
				   window.setTimeout( revertButton, 2000 ); // 2 seconds
				});

		        // $('#createNewCommunicationForm')[0].reset(); // empty the form
			//	swal("Nice!", "'" + title +"' has been updated", "success");        
		    }
		}).done(function(response){
			//console.log(response);
		});    	
    }


    return false;
});
