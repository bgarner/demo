$('body').on('blur','#targets_chosen', function(){
	
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var event_id = $("#eventID").val();
	
	$("#event-type-selector").empty()
									.load('/admin/target/eventtypes', { 
										target_stores : target_stores, 
										target_banners : target_banners,
										store_groups : store_groups,
										event_id : event_id
									 });

});
$("#add-more-attachments").click(function(){
	console.log('add folders');
	$("#folder-listing").modal('show');

});

$('#attach-selected-folders').on('click', function(){

		console.log('attaching folders');
		$(".selected-attachments").remove();

		$('input[name^="package_folders"]').each(function(){

			var attr = $(this).attr('data-folderRoot');

			// For some browsers, `attr` is undefined; for others,
			// `attr` is false.  Check for both.
			if (typeof attr !== typeof undefined && attr !== false) {

			    $(".event-attachments-table tbody").append(	'<tr class="selected-attachments"> '+
													'<td data-attachment-id='+ $(this).val() +'><i class="fa fa-folder-o"></i> '+ $(this).attr("data-foldername") +'</td>'+
													'<td></td>'+
													'<td> <a data-attachment-id="'+ $(this).val()+'" id="attachment'+ $(this).val()+'" class="remove-staged-attachment btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
			}

		});
	});

$("body").on('click', ".remove-staged-attachment", function(){

	var folder_id = $(this).attr('data-attachment-id');
	$(this).closest('.selected-attachments').fadeOut(200, function(){
		$(this).closest('.selected-attachments').remove();
	});


});
$(".remove-attachment").on('click', function(){
	var folder_id = $(this).attr('data-folder-id');
	$(this).closest(".event-attachments").fadeOut(200, function(){
		$("#attachments-staged-to-remove").append('<div class="remove_folder" data-folderid='+ folder_id +'>')
	});


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

$(document).on('click','.event-update',function(){

  	var hasError = false;

  	var eventID = $("#eventID").val();
	var eventBanner = $("#banner").val();
	var eventTitle = $("#title").val();
    var eventType = $("#event_type").val();
    var eventDescription = CKEDITOR.instances['description'].getData();
    var eventStart = $("#start").val();
    var eventEnd = $("#end").val();
    var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var all_stores = getAllStoreStatus();
	var attachments = [];
	var remove_attachments = [];

	if($("#all-day").is(':checked')){
		var allDay = 1;
	} else {
		var allDay = 0;
	}

	console.log(allStores);

	$(".selected-attachments").each(function(){
		attachments.push($(this).find('td:first').attr('data-attachment-id'));
	});
	$(".remove_folder").each(function(){
		remove_attachments.push($(this).attr('data-folderid'));
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
	if( target_stores == null || all_stores == null || store_groups == null ) {
		swal("Oops!", "Target stores not selected.", "error");
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
    if(hasError == false) {

		$.ajax({
		    url: '/admin/calendar/' + eventID ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
				id                 : eventID,
				title              : eventTitle,
				description        : eventDescription,
				event_type         : eventType,
				start              : eventStart,
				end                : eventEnd,
				allDay             : allDay,				
				target_stores      : target_stores,
				all_stores         : all_stores,
				target_banners     : target_banners,
				store_groups       : store_groups,
				attachments        : attachments,
				remove_attachments : remove_attachments
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
		        	if(errors.hasOwnProperty("allStores")) {
		        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[0]  + '</div>');
		        	}
		        }
		        else{
		        	swal({title:"Nice!", text: "'" + eventTitle +"' has been updated", type: 'success'}, function(){
						window.location = '/admin/calendar';
					});
		        }


		    }
		});
    }


    return false;
});
