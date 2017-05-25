$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen('chosen:updated');

		$("#storeSelect option").each(function(index){			
			$(this).prop('selected', 'selected');
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



$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});

$('body').on('click', '#attach-selected-files', function(){
	$("#files-selected").empty();
	$("#files-selected").append('<label class= "control-label col-sm-2 "> Documents attached</label>');
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<div class="selected-files col-sm-10 col-sm-offset-2" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</div>')
		}
	});
});


$(document).on('click','.task-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['body'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var task_documents = [];
	var all_stores  = $("#allStores:checked").val();
	var send_reminder = ($("#send_reminder").prop('checked') === true)?1:0;

	console.log(send_reminder);

	$(".selected-files").each(function(){
		task_documents.push($(this).attr('data-fileid'));
	});
	
 
    if(title == '' ) {
		swal("Oops!", "We need a title for the task.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(due_date == '' ) {
		swal("Oops!", "We need a due date for the task.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
	if( target_stores == null && typeof all_stores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/task',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		  		title : title,
		  		description : description,
		  		publish_date : publish_date,
		  		due_date : due_date,
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		all_stores : all_stores,
		  		task_documents : task_documents,
		  		send_reminder : send_reminder
		    },
		    success: function(result) {
		    	console.log(result);
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("due_date")) {
		        		$.each(errors.due_date, function(index){
		        			$("#due_date").parent().append('<div class="req">' + errors.due_date[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("target_stores")) {
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	$('#createNewTaskForm')[0].reset(); // empty the form
		        	swal({
		        		title : 'Nice!',
		        		text : title + " has been created",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.reload();
		        	})
		        }
		        
		    }
		}).done(function(response){
			$(".search-field").find('input').val('');
			processStorePaste();
		});    	
    }


    return false;
});
