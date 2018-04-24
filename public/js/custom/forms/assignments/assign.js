$(document).ready(function(){
	$("#show_update_status").hide();	
	
});

$("body").on('click', "#select_all", function(){
	if($(this).is(':checked')){
		$(".select_form").prop("checked", true);
		$("#show_update_status").show();
	}
	else{
		$(".select_form").prop("checked", false);
		$("#show_update_status").hide();	
	}
});
$("body").on('click', '.select_form', function(){
	if(!$(this).is(":checked")){
		$("#select_all").prop('checked', false);
	}
	if($(".select_form:checked").length >0){
		$("#show_update_status").show();
	}
	else{
		$("#show_update_status").hide();
	}
});


$("#assign_to_user").click(function(){
	$("#user_assignment_modal").modal('show');
});

$("#assign_to_group").click(function(){
	$("#group_assignment_modal").modal('show');
});

$(".assign_to_self").click(function(){
	
	
	var user_id = $(this).data('userid');
	var form_instance_id = $(this).data('forminstanceid');

	$.ajax({
	    url: '/form/assignment/forminstance/' + form_instance_id ,
	    type: 'PATCH',
	    data: { 'user_id': user_id  },
	    // async: false,
	    success: function(result) {
	    	acknowledgeUpdate();
	    }
	}).done(function(response){
		
	});   
	
});

$("#show_update_status").click(function(){
	$("#status_update_modal").modal('show');
})

$("#show_update_status_group_assign").click(function(){
	$("#status_update_modal").modal('show');
})

$("#update_form_status").click(function(){
 
 	var selectedForms = $(".tab-pane.active").find(".select_form:checked");
	
	$.each(selectedForms, function(index, form){
		var form_instance_id = $(this).attr('data-formInstanceId');	
		updateFormInstanceStatus(form_instance_id);
	});

	$('#status_update_modal').modal('hide');


});


$("#update_user_assignment").click(function(){
	
	var user_id = $(".user-checkbox:checked").data('userid');
	console.log(user_id);
	var selectedForms = $(".select_form:checked");
	$.each(selectedForms, function(index, form){
		var form_instance_id = $(this).attr('data-formInstanceId');		
		$.ajax({
		    url: '/form/assignment/forminstance/' + form_instance_id ,
		    type: 'PATCH',
		    data: { 'user_id': user_id  },
		    success: function(result) {
		    	acknowledgeUpdate();
		    }
		}).done(function(response){
			
		});   
	}); 
});


$("#update_group_assignment").click(function(){
	var group_id = $(".group-checkbox:checked").data('groupid');
	var selectedForms = $(".select_form:checked");
	$.each(selectedForms, function(index, form){
		var form_instance_id = $(this).attr('data-formInstanceId');		
		$.ajax({
		    url: '/form/assignment/forminstance/' + form_instance_id ,
		    type: 'PATCH',
		    data: { 'group_id': group_id},
		    success: function(result) {
		    	acknowledgeUpdate();
		    }
		}).done(function(response){
			
		});   
	}); 
});


var acknowledgeUpdate = function(){
	swal({
                title : "",
                text : "Asssignment Updated",
                type : "success",
            },
            function(){
                
                    window.location.reload();
                
                
            });
};
