$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});

	showDropdowns();
	
});


$("#group").change(function(){
	showDropdowns();
});

$(document).on('click','.role-edit',function(){
  	
  	var hasError = false;

  	var role_name = $("#role_name").val();
  	var role_id = $("#roleID").val();
    var group  = $("#group").val();
    var components = $("#components").val();
    var resource_type = $("#resource_type").val();
    var forms = $("#forms").val();


    console.log(role_name, 
		    	group, 
		    	components, 
		    	resource_type);
		    	
	
    if(role_name == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/role/' + role_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: role_id,
		  		role_name: role_name,
		    	group : group,
		    	components : components,
		    	resource_type : resource_type,
		    	forms:forms
		    },

		    success: function(result) {
		    	console.log(result);
		      	if(result.validation_result == 'false') {
		    		var errors = result.errors;
			        	if(errors.hasOwnProperty("role_name") || errors.hasOwnProperty("role_id")) {
			        		$.each(errors.role_name, function(index){
			        			$('#role_name').parent().append('<div class="req">' + errors.role_name[index]  + '</div>');	
			        		});

			        		$.each(errors.role_id, function(index){
			        			$('#role_name').parent().append('<div class="req">' + errors.role_id[index]  + '</div>');	
			        		});
			        	}

			        	if(errors.hasOwnProperty("group")) {
			        		$.each(errors.group, function(index){
			        			$('#group').parent().append('<div class="req">' + errors.group[index]  + '</div>');	
			        		}); 	
			        	}
			        	if(errors.hasOwnProperty("components")) {
			        		$.each(errors.components, function(index){
			        			$('#components').parent().append('<div class="req">' + errors.components[index]  + '</div>');	
			        		}); 	
			        	}
			        	if(errors.hasOwnProperty("resource_type")) {
			        		$.each(errors.resource_type, function(index){
			        			$('#resource_type').parent().append('<div class="req">' + errors.resource_type[index]  + '</div>');	
			        		}); 	
			        	}
		    	}
		    	else{
		        	swal({title:"Nice!", text: "'" + role_name +"' has been updated", type: 'success'});      	
		        }

				
		    }
		});    	
    }


    return false;
});

var showDropdowns = function(){
	var groupId = $("#group").val();
	if(groupId == 1)
	{
		$("#components").closest('.form-group').show();
		$("#resource_type").closest('.form-group').hide();
		$("#forms").closest('.form-group').hide();

	}
	if(groupId == 2)
	{
		$("#resource_type").closest('.form-group').show();
		$("#components").closest('.form-group').hide();
		$("#forms").closest('.form-group').hide();
		$("#components").val('').trigger("chosen:updated");
	}
	if(groupId == 3)
	{
		$("#forms").closest('.form-group').show();
		$("#resource_type").closest('.form-group').hide();
		$("#components").closest('.form-group').hide();
		$("#components").val('').trigger("chosen:updated");
	}
}