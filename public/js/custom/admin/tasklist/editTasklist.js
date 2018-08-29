$("#add-more-tasks").click(function(){
	$("#task-listing").modal('show');
});
$('body').on('click', '#attach-selected-tasks', function(){

	$('input[name^="tasklist_tasks"]').each(function(){
		
		if($(this).is(":checked")){
			$(".tasklist-tasks-table").find("tbody").append('<tr class="tasklist_task"> '+
													'<td class="selected-task" data-taskid='+ $(this).val() +'>'+$(this).attr("data-tasktitle")+'</td>'+
													'<td></td>'+
													'<td class="align-right"> <a data-task-id="'+ $(this).val()+'" id="task'+ $(this).val()+'" class="remove-staged-task btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
	});
});


$('body').on('click', ".remove-task", function(){
	var task_id = $(this).attr('data-task-id');
	$(this).closest('tr').fadeOut(200);
	$("#tasks-staged-to-remove").append('<div class="remove_task"  data-taskid='+ task_id +'>')
});

$("body").on('click', ".remove-staged-task", function(){
	
	$(this).closest('tr').fadeOut(500).remove();

});


$(document).on('click','.tasklist-update',function(){
  	
  	var hasError = false;
 	var tasklistId = $("#tasklistId").val();
 	
 	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();

	var remove_tasks = [];
	var tasks = [];

	$(".remove_task").each(function(){
		remove_tasks.push($(this).attr('data-taskid'));
	});
	
	$(".selected-task").each(function(){
		tasks.push($(this).attr('data-taskid'));
	});

	console.log(remove_tasks);

    if(title == '' ) {
		swal("Oops!", "We need a title.", "error"); 
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
		  		title             : title,
		  		description       : description,
		  		tasks             : tasks,
		  		remove_tasks      : remove_tasks
		    },
		    
		    success: function(result) {
		       
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
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