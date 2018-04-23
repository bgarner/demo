$(document).ready(function(){
	$("#edit_multiple_forms").hide();	
});

$("body").on('click', "#select_all", function(){
	if($(this).is(':checked')){
		$(".select_form").prop("checked", true);
		$("#edit_multiple_forms").show();
	}
	else{
		$(".select_form").prop("checked", false);
		$("#edit_multiple_forms").hide();	
	}
});
$("body").on('click', '.select_form', function(){
	if(!$(this).is(":checked")){
		$("#select_all").prop('checked', false);
	}
	if($(".select_form:checked").length >0){
		$("#edit_multiple_forms").show();
	}
	else{
		$("#edit_multiple_forms").hide();
	}
});


$("#assign_to_user").click(function(){
	$("#user_assignment_modal").modal('show');
});

$("#assign_to_group").click(function(){
	$("#group_assignment_modal").modal('show');
});

$("#assign_to_self").click(function(){
	
	var user_id = $(this).data('userid');
	var selectedForms = $(".select_form:checked");
	$.each(selectedForms, function(index, form){
		var form_instance_id = $(this).attr('data-formInstanceId');		
		$.ajax({
		    url: '/form/assignment/forminstance/' + form_instance_id ,
		    type: 'PATCH',
		    data: { 'user_id': user_id  },
		    async: false,
		    success: function(result) {
		       $("tr[data-formInstanceid='"+result.id+"']").find(".assignedToUser").html(result.assignedTo);
		    }
		}).done(function(response){
			
		});   
	}); 
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
		    async: false,
		    success: function(result) {
		       $("tr[data-formInstanceid='"+result.id+"']").find(".assignedToUser").html(result.assignedTo);
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
		    async: false,
		    success: function(result) {
		       $("tr[data-formInstanceid='"+result.id+"']").find(".assignedToGroup").html(result.assignedTo);
		    }
		}).done(function(response){
			
		});   
	}); 
});
