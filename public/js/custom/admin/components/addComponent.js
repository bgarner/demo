$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.component-create',function(){
  	
  	var hasError = false;

    var component_name = $("#component_name").val();
    var roles =  $("#roles").val();
    var bannerId = localStorage.getItem('admin-banner-id');


    if(component_name == '') {
		swal("Oops!", "This we need a name for this component.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/component',
		    type: 'POST',
		    data: { component_name: component_name, roles: roles, banner_id: bannerId },
		    success: function(result) {
		        console.log(result);
		        $("#section").val(""); // empty the form
				swal("Nice!", "'" + component_name +"' has been created", "success");        
		    }
		});
	}
	
    return false;
}); 