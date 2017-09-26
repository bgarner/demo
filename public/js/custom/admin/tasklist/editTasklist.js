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


var stageTask = function(){

	var taskTitle =  $("#new_task").val();
	if(taskTitle == ''){
		return false;
	}
	$(".task-table tbody").append(
		'<tr>'+
            '<td class="col-sm-10 col-sm-offset-2 task-title new_task" '+
                '>'+
                $("#new_task").val()+
            '</td>'+
        '<td></td>'+
        '<td><a '+
                '" class="remove-staged-task btn btn-danger btn-sm">'+
                '<i class="fa fa-trash"></i></a></td>'+
        '</tr>'

	);
	$(".task-table").removeClass('hidden').addClass('visible');	
	$("#new_task").val('');
};

$( "#new_task" ).keypress(function( event ) {
  if ( event.which == 13 ) {
    event.preventDefault();
    stageTask();
  }  
  
});


$('body').on('click', ".remove-task", function(){
	var task_id = $(this).attr('data-task-id');
	$(this).closest('tr').fadeOut(200);
	$("#tasks-staged-to-remove").append('<div class="remove_task"  data-taskid='+ task_id +'>')
});

$("body").on('click', ".remove-staged-task", function(){
	
	$(this).closest('tr').fadeOut(500).remove();

});

 


$('body').on('click', ".remove-staged-task", function(){
    $(this).parent().parent().fadeOut(500).remove();
});

$(document).on('click','.tasklist-update',function(){
  	
  	var hasError = false;
 	var tasklistId = $("#tasklistId").val();
 	
 	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	// var banner_id = $("input[name='banner_id']").val();
	var target_stores  = getTargetStores();
	var all_stores  = $("#allStores:checked").val();
	// var send_reminder = ($("#send_reminder").prop('checked') === true)?1:0;
	// var status_type_id = $("#status_type_id").val();

	var remove_tasks = [];
	var tasks = [];

	$(".new_task").each(function(index, value){
		tasks.push($(this).text());
	});


	$(".remove_task").each(function(){
		remove_tasks.push($(this).attr('data-taskid'));
	});


	console.log(tasks);
	console.log(remove_tasks);

    if(title == '' ) {
		swal("Oops!", "We need a title.", "error"); 
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
		    url: '/admin/tasklist/' + tasklistId,
		    type: 'PATCH',
		    dataType : 'json',
		    data: {

		  		title          : title,
		  		description    : description,
		  		publish_date   : publish_date,
		  		due_date       : due_date,
		  		target_stores  : target_stores,
		  		all_stores     : all_stores,
		  		tasks          : tasks,
		  		remove_tasks   : remove_tasks,
		  		// status_type_id : status_type_id

		    },
		    
		    success: function(result) {
		       
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#add-documents").parent().append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        
			        if(errors.hasOwnProperty("publish_date")) {
			        	$.each(errors.publish_date, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.publish_date[index]  + '</div>');	
			        	});
			        }
			        
			        if(errors.hasOwnProperty("due_date")) {
			        	$.each(errors.due_date, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.due_date[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("all_stores")) {
			        	$.each(errors.allStores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
					swal("Nice!", "'" + title +"' has been updated", "success");
		        } 
		        

		    }
		}).done(function(response){
			$(".existing-files-container").load("/admin/tasklist/" + tasklistId + "/tasks/");
			$("#files-staged-to-remove").empty();
			$("#files-selected").empty();
			$("#document-listing").find(".document-checkbox").prop('checked', false);
		});    	
    }


    return false;
});

$(document).on('click','.tasklist-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = getTargetStores();
	var task_documents = [];
	var all_stores  = $("#allStores:checked").val();
	// var send_reminder = ($("#send_reminder").prop('checked') === true)?1:0;
	var tasks = [];
	$(".task-title").each(function(index, value){
		tasks.push($(this).text());
	});	
 
    if(title == '' ) {
		swal("Oops!", "We need a title for the tasklist.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(due_date == '' ) {
		swal("Oops!", "We need a due date for the tasklist.", "error"); 
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

	console.log(title);

    if(hasError == false) {

		$.ajax({
		    url: '/admin/tasklist',
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
		  		tasks : tasks
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
			        if(errors.hasOwnProperty("tasks")) {
			        	$.each(errors.tasks, function(index){
			        		$("#new_task").parent().append('<div class="req">' + errors.tasks[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	// $('#createNewTaskForm')[0].reset(); // empty the form
		        	swal({
		        		title : 'Nice!',
		        		text : title + " has been updated",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.reload();
		        	})
		        }
		        
		    }
		}).done(function(response){
			// $(".search-field").find('input').val('');
			// processStorePaste();
		});    	
    }

    return false;
});
