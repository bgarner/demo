$(document).ready(function(){
	if($("#allStores").prop('checked')) {
		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
	}
	initializeTagSelector();


});
var initializeTagSelector = function(){
	
	$("#tags").select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === ''  && $("#tags").find('option').attr("tagname", term).length >0) {
		      return null;
		    }

		    return {
		      id: term, //id of new option 
		      text: term, //text of new option 
		      newTag: true
		    }
		}
	});
	
}

$("body").on('select2:select', $("#tags"), function (evt) {

	var document_id = $("#documentID").val();
    if(evt.params.data.newTag){
    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
    	.done(function(tag){
    		
    		//change the id of the newly added tag to be the id from db
			$('#tags option[value="'+tag.name+'"]').val(tag.id);
			
			var selectedTags = $("#tags").val();
			//update tag document mapping
			$.post("/admin/documenttag",{ 'document_id' : document_id, 'tags': selectedTags })
			.done(function(){
				$('#tags').select2('destroy');
				$("#tag-selector-container").load("/admin/documenttag/"+document_id, function(){
					initializeTagSelector();
					$("#tags").focus();

				});	
			});				

    	});
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
	var banner_id = $("input[name='banner_id']").val();
	
	var target_stores = getTargetStores();
	var allStores = $("#allStores:checked").val();

	var tags = $("#tags").val();
	console.log(tags);

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
		
	} 

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
		  		banner_id : banner_id,
		  		stores : target_stores,
		  		document_start : document_start,
		  		document_end : document_end,
		  		all_stores : allStores,
		  		tags : tags,

		  		
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
