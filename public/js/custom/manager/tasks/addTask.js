$(document).ready(function(){
	$("#due_date_ibox").slideUp();
	$("#store_selector_ibox").slideUp();
	$(".task_status_box").slideUp();
	$(".task-status").hide();
	$(".chosen").chosen({
		width : '100%'
	});
	$(".project-row-detail td").hide();
	$(".project-row-detail").hide();
	$(".updated_due_date_selector").datetimepicker({
	
		format: 'YYYY-MM-DD',

	})
});

var toggleSendReminder = function(element){
	
	var state = $(element).attr('data-state');
	if(state == 1){
		$(element).attr('data-state', 0);
		$(element).find('i').removeClass('fa fa-check-square-o').addClass('fa fa-square-o');

	}
	else if(state == 0){
		$(element).attr('data-state', 1);
		$(element).find('i').removeClass('fa fa-square-o').addClass('fa fa-check-square-o');	
	}
}


$('#due_date_popover').click( function() {
	$("#due_date_popover i").toggleClass('task-element-in-process');
	$("#due_date_ibox").slideToggle();
});

$("#due_date_selector").datetimepicker({
	
	format: 'YYYY-MM-DD',
	inline: true

}).on('dp.change', function(e){ 

	var selected_date = e.date.format("YYYY-MM-DD");
	var due_date = $("#due_date").val();
	if( selected_date != due_date ){
		
		$("#due_date").val( selected_date );
		$("#due_date_popover i").removeClass('task-element-in-process').addClass('task-element-selected');	
	}
	$("#due_date_ibox").delay(5000).slideUp();

});

$("#clear_due_date").click(function(){
	$("#due_date").val('');
	$("#due_date_popover i").removeClass('task-element-selected');
	$("#due_date_ibox").clearQueue();
});

$("#send_reminder").click(function(){

	toggleSendReminder($(this));
	
});

$("#store_select_popover").click(function(){

	$("#store_select_popover i").toggleClass('task-element-in-process');
	$("#store_selector_ibox").slideToggle();
})

$("#allStores").click(function(){

	var state = $(this).attr('data-state');

	if(state == 0) {
		
		$(this).attr('data-state', 1);
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen('chosen:updated');

		$("#storeSelect option").each(function(index){			
			$(this).prop('selected', 'selected');

		});
		$("#storeSelect").chosen();
		$("#store_selector_ibox").delay(5000).slideUp();
		$("#store_select_popover i").removeClass('task-element-in-process').addClass('task-element-selected');	
		$(this).find('i').removeClass('fa fa-square-o').addClass('fa fa-check-square-o');

	}
	else if(state ==1) {

		
		$(this).attr('data-state', 0);	
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});

		$("#storeSelect").chosen();
		$("#store_selector_ibox").clearQueue();
		$("#store_select_popover i").removeClass('task-element-selected');	
		$(this).find('i').removeClass('fa fa-check-square-o').addClass('fa fa-square-o');
	}

});

$('.chosen').on('change', function(event, params) {
	var selectedStores = $("#storeSelect").val();
	console.log(selectedStores);
	if( selectedStores !== null && selectedStores.length > 0) {
		$("#store_select_popover i").removeClass('task-element-in-process').addClass('task-element-selected');	
	}
	else{
		$("#store_select_popover i").addClass('task-element-in-process').removeClass('task-element-selected');		
	}
});

$("#confirm-store-select").click(function(){
	$("#store_selector_ibox").slideToggle();
});

$(".edit-task").click(function(e){

	var modal = $('#edit-task-modal');
	var modalBody = $('#edit-task-modal .modal-content');
	modalBody.empty();

	var taskId = $(this).attr('data-task-id');
	var taskEditLink = e.delegateTarget.href;

	modal
	    .on('show.bs.modal', function() {
	        
	        modalBody.load(taskEditLink);

	        
	    })
	    .modal({show:true})
	    .on('shown.bs.modal', function () {
	        $('input[name="title"]' ).focus();
	        $('.chosen', this).chosen({
	        	width:'90%'
	        });
	        $(".due_date_selector").datetimepicker({
				format: 'YYYY-MM-DD'
	        })
	    });
	e.preventDefault();
});


$(".project-completion").click(function(){
	
	var taskId = $(this).parent().attr('data-task-id');
	
	if($("#task_status_" + taskId).is(':visible')) {
		$("#task_status_box_" + taskId ).slideUp(600, function(){
			$("#task_status_" + taskId).hide();	
		}); 	
	}
	else{
		$("#task_status_" + taskId).toggle();
		$("#task_status_box_" + taskId ).slideDown(600);
	}
	
	
})

$("body").on('click', '.send_reminder', function(){
	toggleSendReminder($(this));
	var task_id = $(this).attr('data-task-id');
	$("body #send_reminder_" + task_id).attr('value', $(this).attr('data-state'));
});

$(document).on('click','.task-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var due_date = $("#due_date").val();
	var target_stores  = $("#storeSelect").val();
	var send_reminder = $("#send_reminder").attr('data-state');
	
    if(title == '' ) {
		swal("Oops!", "We need a title for the task.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
	if( target_stores == null) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$("#store_selector_ibox").slideDown(800);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/manager/task',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		  		title : title,
		  		due_date : due_date,
		  		banner_id : 1,
		  		target_stores : target_stores,
		  		send_reminder : send_reminder
		    },
		    success: function(result) {
		    
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("target_stores")) {
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        	$("#store_selector_ibox").slideDown(800);
			        }
		        }
		        else{
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
