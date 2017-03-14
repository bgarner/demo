$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.role-create',function(){
  	
  	var hasError = false;

    var role_name = $("#role_name").val();
    var groups =  $("#groups").val();
    var components =  $("#components").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    console.log(role_name);
    console.log(groups);
    console.log(components);
    if(role_name == '') {
		swal("Oops!", "This we need a name for this role.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/role',
		    type: 'POST',
		    data: { role_name: role_name, groups: groups, components : components, banner_id: bannerId },
		    success: function(result) {
		        console.log(result);
		        $("#role").val(""); // empty the form
				swal("Nice!", "'" + role_name +"' has been created", "success");        
		    }
		});
	}
	
    return false;
}); 