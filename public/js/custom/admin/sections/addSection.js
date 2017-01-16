$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.section-create',function(){
  	
  	var hasError = false;

    var section_name = $("#section_name").val();
    var groups =  $("#groups").val();
    var bannerId = localStorage.getItem('admin-banner-id');


    if(section == '') {
		swal("Oops!", "This we need a name for this section.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/section',
		    type: 'POST',
		    data: { section_name: section_name, groups: groups, banner_id: bannerId },
		    success: function(result) {
		        console.log(result);
		        $("#section").val(""); // empty the form
				swal("Nice!", "'" + section +"' has been created", "success");        
		    }
		});
	}
	
    return false;
}); 