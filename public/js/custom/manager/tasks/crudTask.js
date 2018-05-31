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
    	format: 'YYYY-MM-DD 00:00:00',
    	defaultDate : $("#task_publish_date").val()
    }).on("dp.change",function (e) {
       $("#task_publish_date").val($('#publish_date').data().DateTimePicker.date().format("YYYY-MM-DD 00:00:00"));
    });

    $('#due_date').datetimepicker({
    	format: 'YYYY-MM-DD 23:59:59',
    	defaultDate : $("#task_due_date").val()
    }).on("dp.change",function (e) {
       $("#task_due_date").val($('#due_date').data().DateTimePicker.date().format("YYYY-MM-DD 23:59:59"));
    });
    
});

$('#store_select_popover').popover({
   
    placement: 'bottom',
    title: 'Select Stores',
    html: true,
    content:  $('#store_container').html()

}).on('shown.bs.popover', function () {
    $(".chosen").chosen({
        width:'100%'
    });
    $('#storeSelect').on('change', function(e) {
        $("#task_target").val($("#storeSelect").val());
    });
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
            
            $(this).find('i').removeClass('fa fa-square-o').addClass('fa fa-check-square-o');
            $("#task_target").val($("#storeSelect").val());

        }
        else if(state ==1) {

            
            $(this).attr('data-state', 0);  
            $("#storeSelect option").each(function(){
                $(this).removeAttr('selected');
            });

            $("#storeSelect").chosen();
            $(this).find('i').removeClass('fa fa-check-square-o').addClass('fa fa-square-o');
            $("#task_target").val($("#storeSelect").val());
        }
    });
    
});


$('#description_popover').popover({
   
    placement: 'bottom',
    title: 'Description',
    html: true,
    content:  $('#description_container').html()

}).on('shown.bs.popover', function () {
    
    CKEDITOR.replace('description');
    CKEDITOR.instances['description'].on('change', function() {
        
        $("#task_description").val(CKEDITOR.instances['description'].getData());
        console.log($("#task_description").val());
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

$(document).on('click','.task-create',function(){
    
    var hasError = false;
 
    var title = $("#task_title").val();
    var due_date = $("#task_due_date").val();
    var publish_date = $("#task_publish_date").val();
    var target_stores  = $("#task_target").val().split(",");
    var description = $("#task_description").val();

     
    if(title == '' ) {
        swal("Oops!", "We need a title for the task.", "error"); 
        hasError = true;
        $(window).scrollTop(0);
        return false;
    }
    if(description == '' ) {
        swal("Oops!", "We need a description for the task.", "error"); 
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
                target_stores : target_stores,
                description : description,
                publish_date : publish_date,
                send_reminder : 0

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
            console.log(response);
            $(".search-field").find('input').val('');
        });     
    }


    return false;
});

$("#description_popover").click(function(){
    $("#description_popover i").toggleClass('task-element-in-process');
    $("#description_ibox").slideToggle();
})

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
                format: 'YYYY-MM-DD 23:59:59'
            })
            $(".publish_date_selector").datetimepicker({
                format: 'YYYY-MM-DD 00:00:00'
            })
        });
    e.preventDefault();
});
