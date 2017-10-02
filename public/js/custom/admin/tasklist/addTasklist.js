var stageTask = function(){

	var taskTitle =  $("#new_task").val();
	if(taskTitle == ''){
		return false;
	}
	$(".task-table tbody").append(
		'<tr>'+
            '<td class="col-sm-10 col-sm-offset-2 task-title" '+
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
 

$('body').on('click', ".remove-staged-task", function(){
    $(this).parent().parent().fadeOut(500).remove();
});

$(document).on('click','.tasklist-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var all_stores = getAllStoreStatus();
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
		  		target_stores  : target_stores,
		  		all_stores     : all_stores,
		  		target_banners : target_banners,
		  		store_groups   : store_groups,
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
		        		text : title + " has been created",
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
