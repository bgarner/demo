$("#add-tasks").click(function(){
	$("#task-listing").modal('show');
});

$('body').on('click', '#attach-selected-tasks', function(){
	
	if($('.tasklist-tasks-table').hasClass('hidden')){
		$(".tasklist-tasks-table").removeClass('hidden').addClass('visible');
	}
	$(".tasklist-tasks-table").find("tbody").empty();
	$('input[name^="tasklist_tasks"]').each(function(){
		
		if($(this).is(":checked")){
			
			$(".tasklist-tasks-table").find("tbody").append('<tr class="tasklist_task"> '+
													'<td data-taskid='+ $(this).val() +'>'+$(this).attr("data-tasktitle")+'</td>'+
													'<td></td>'+
													'<td class="align-right"> <a data-task-id="'+ $(this).val()+'" id="task'+ $(this).val()+'" class="remove-staged-task btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
	});
});

 

$('body').on('click', ".remove-staged-task", function(){
    $(this).parent().parent().fadeOut(500).remove();
});

$(document).on('click','.tasklist-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var tasks = [];
	$(".tasklist_task").each(function(){
		tasks.push($(this).find('td:first').attr('data-taskid'));
	});
 
    if(title == '' ) {
		swal("Oops!", "We need a title for the tasklist.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}


    if(hasError == false) {

		$.ajax({
		    url: '/admin/tasklist',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		  		title             : title,
		  		description       : description,
		  		tasks             : tasks
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
		        		text : title + " has been created",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.reload();
		        	})
		        }
		        
		    }
		}).done(function(response){
			
		});    	
    }

    return false;
});
