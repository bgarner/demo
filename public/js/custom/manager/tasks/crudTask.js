$(document).ready(function(){
	$(".task_status_box").slideUp();
	$(".task-status").hide();
	$(".project-row-detail td").hide();
	$(".project-row-detail").hide();
});


$('#date_popover').popover({
   
    placement: 'bottom',
    title: 'Select Dates',
    html: true,
    content:  $('#date_container').html()

}).on('shown.bs.popover', function () {
    $('#publish_date').datetimepicker({
    	format: 'YYYY-MM-DD',
    	defaultDate : $("#task_publish_date").val()
    }).on("dp.change",function (e) {
       $("#task_publish_date").val($('#publish_date').data().DateTimePicker.date().format("YYYY-MM-DD"));
    });

    $('#due_date').datetimepicker({
    	format: 'YYYY-MM-DD',
    	defaultDate : $("#task_due_date").val()
    }).on("dp.change",function (e) {
       $("#task_due_date").val($('#due_date').data().DateTimePicker.date().format("YYYY-MM-DD"));
    });
    
});

$('#date_popover').popover({
   
    placement: 'bottom',
    title: 'Select Stores',
    html: true,
    content:  $('#store_container').html()

}).on('shown.bs.popover', function () {
    $('#publish_date').datetimepicker({
    	format: 'YYYY-MM-DD',
    	defaultDate : $("#task_publish_date").val()
    }).on("dp.change",function (e) {
       $("#task_publish_date").val($('#publish_date').data().DateTimePicker.date().format("YYYY-MM-DD"));
    });

    $('#due_date').datetimepicker({
    	format: 'YYYY-MM-DD',
    	defaultDate : $("#task_due_date").val()
    }).on("dp.change",function (e) {
       $("#task_due_date").val($('#due_date').data().DateTimePicker.date().format("YYYY-MM-DD"));
    });
    
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
	
	
});