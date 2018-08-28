// var stageTask = function(){

// 	var taskTitle =  $("#new_task").val();
// 	if(taskTitle == ''){
// 		return false;
// 	}
// 	$(".task-table tbody").append(
// 		'<tr class="tasklist-task">'+
//             '<td class="col-sm-4 col-sm-offset-2 task-title new_task" '+
//                 '>'+$("#new_task").val()+
//             '</td>'+
//         '<td class="col-sm-4 task-description new_task_description">'+ CKEDITOR.instances['task_description'].getData() +'</td>'+
//         '<td><a '+
//                 '" class="remove-staged-task btn btn-danger btn-sm">'+
//                 '<i class="fa fa-trash"></i></a></td>'+
//         '</tr>'

// 	);
// 	$(".task-table").removeClass('hidden').addClass('visible');	
// 	$("#new_task").val('');
// };

// $( "#new_task" ).keypress(function( event ) {
//   if ( event.which == 13 ) {
//     event.preventDefault();
//     stageTask();
//   }  
  
// });


// $('#description_popover').popover({
   
//     placement: 'bottom',
//     title: 'Description',
//     html: true,
//     content:  $('#description_container').html()

// }).on('shown.bs.popover', function () {
    
//     CKEDITOR.replace('task_description');
//     CKEDITOR.instances['task_description'].on('change', function() {
        
//         // $("#task_description").val(CKEDITOR.instances['description'].getData());
//         // console.log($("#task_description").val());
//     });
    
// });



$('body').on('click', ".remove-task", function(){
	var task_id = $(this).attr('data-task-id');
	$(this).closest('tr').fadeOut(200);
	$("#tasks-staged-to-remove").append('<div class="remove_task"  data-taskid='+ task_id +'>')
});

$("body").on('click', ".remove-staged-task", function(){
	
	$(this).closest('tr').fadeOut(500).remove();

});

// $("body").on('click', ".tasklist-task", function(e){
	
// 	var taskId = $(this).attr('data-taskid');
// 	var taskTitle = $(this).find('.task-title').html();
// 	var taskDescription = $(this).find('.task-description').html();

// 	var modal = $('#edit-task-modal');
// 	var modalBody = $('#edit-task-modal .modal-content');
    
//     modal
//         .on('show.bs.modal', function() {
//             modalBody.find('input[name="task_title"]').val(taskTitle);
//             modalBody.find('input[name="task_description"]').val(taskDescription);
//             var textarea = document.getElementById('task_description_modal');
//             CKEDITOR.replace(textarea);
// 			CKEDITOR.instances['task_description_modal'].setData(taskDescription);
//         })
//         .modal({show:true})
//         .on('shown.bs.modal', function () {
//             $('input[name="task_title"]').focus();
//         })
//         .on('hidden.bs.modal', function(){

//         	var newTitle = $('input[name="task_title"]').val();
//         	var newDescription = CKEDITOR.instances['task_description_modal'].getData();	
//         	console.log(newTitle, newDescription);
//         	CKEDITOR.instances['task_description_modal'].destroy();
//         })
    
//     e.preventDefault();

// });

// var updateTask = function(){

// }


$(document).on('click','.tasklist-update',function(){
  	
  	var hasError = false;
 	var tasklistId = $("#tasklistId").val();
 	
 	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var all_stores = getAllStoreStatus();

	var remove_tasks = [];
	var tasks = [];
	var task_descriptions = [];

	$(".new_task").each(function(index, value){
		tasks.push($(this).text());
	});

	$(".new_task_description").each(function(index, value){
		task_descriptions.push($(this).html());
	});


	$(".remove_task").each(function(){
		remove_tasks.push($(this).attr('data-taskid'));
	});

    if(title == '' ) {
		swal("Oops!", "We need a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
	if( target_stores.length <= 0  && target_banners.length <= 0  && store_groups.length <= 0  ) {
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

		  		title             : title,
		  		description       : description,
		  		publish_date      : publish_date,
		  		due_date          : due_date,
		  		tasks             : tasks,
		  		remove_tasks      : remove_tasks,
		  		target_stores     : target_stores,
		  		all_stores        : all_stores,
		  		target_banners    : target_banners,
		  		store_groups      : store_groups,
		  		task_descriptions : task_descriptions

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