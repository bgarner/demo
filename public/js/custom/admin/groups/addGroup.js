$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.group-create',function(){
  	
  	var hasError = false;

    var group_name = $("#group_name").val();
    var components =  $("#components").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    console.log(group_name);
    console.log(components);
    if(group_name == '') {
		swal("Oops!", "This we need a name for this group.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/group',
		    type: 'POST',
		    data: { group_name: group_name, components: components, banner_id: bannerId },
		    success: function(result) {
		        console.log(result);
		        $("#group").val(""); // empty the form
				swal("Nice!", "'" + group_name +"' has been created", "success");        
		    }
		});
	}
	
    return false;
}); 