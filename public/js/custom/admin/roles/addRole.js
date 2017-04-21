$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});

	$("#components").closest('.form-group').hide();
	$("#resource_type").closest('.form-group').hide();
});

$("#groups").change(function(){

		var groupId = $("#groups").val();
		if(groupId == 1)
		{
			$("#components").closest('.form-group').show();
			$("#resource_type").closest('.form-group').hide();
		}
		if(groupId == 2)
		{
			$("#resource_type").closest('.form-group').show();
			$("#components").closest('.form-group').hide();
		}

});

$(document).on('click','.role-create',function(){
  	
  	var hasError = false;

    var role_name = $("#role_name").val();
    var groups =  $("#groups").val();
    var components =  $("#components").val();
    var resource_type =  $("#resource_type").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    console.log(role_name);
    console.log(groups);
    console.log(components);
    if(role_name == '') {
		swal("Oops!", "We need a name for this role.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/role',
		    type: 'POST',
		    data: { 
		    	role_name: role_name, 
		    	groups: groups, 
		    	components : components, 
		    	resource_type : resource_type,
		    	banner_id: bannerId 
		    },
		    success: function(result) {
		        console.log(result);
		        $("#role").val(""); // empty the form
				swal("Nice!", "'" + role_name +"' has been created", "success");        
		    }
		});
	}
	
    return false;
}); 